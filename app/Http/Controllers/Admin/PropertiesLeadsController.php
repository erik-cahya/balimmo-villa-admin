<?php

namespace App\Http\Controllers\Admin;

use App\Events\BookingCreated;
use App\Http\Controllers\Controller;
use App\Mail\NotifikasiEmail;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PropertiesLeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 'Master') {
            $data['data_customers'] = PropertyLeadsModel::select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
                ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
                ->get();
        } else {
            $data['data_customers'] = PropertyLeadsModel::where('property_leads.agent_code', Auth::user()->reference_code)
                ->select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
                ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
                ->get();
        }

        $leads = $data['data_customers'];
        $data['matchProperties'] = [];

        if ($leads->isNotEmpty()) {
            // Ambil semua lokasi & budget maksimum
            $regions = $leads->pluck('localization')->unique()->toArray();
            $maxBudget = $leads->max('cust_budget');

            // Ambil semua properti yang mungkin cocok sekaligus
            $properties = PropertiesModel::whereIn('region', $regions)
                ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                ->where('selling_price_idr', '<=', $maxBudget)
                ->get();

            // Kelompokkan properti berdasarkan region
            $groupedProperties = $properties->groupBy('region');

            // Kelompokkan kembali sesuai budget masing-masing lead
            foreach ($leads as $lead) {
                $regionProps = $groupedProperties[$lead->localization] ?? collect();

                $data['matchProperties'][$lead->id] = $regionProps->filter(function ($property) use ($lead) {
                    return $property->selling_price_idr <= $lead->cust_budget;
                })->values(); // reset index
            }
        } else {
            // Kosongkan jika tidak ada leads
            $data['matchProperties'] = [];
        }

        return view('admin.leads.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function booking(Request $request, $slug = null)
    {
        // dd($slug);
        // dd($request->all());



        if ($slug !== null) {
            $request->validate([
                'name' => 'required',
                'phone_number' => 'required',
                'email' => 'required',
                'budget' => 'required',
                'location' => 'required',
                'timing' => 'required',
                'bedroom' => 'required',
            ]);
        } else {
            // Form di landing page
            $request->validate([
                'name' => 'required',
                'phone_number' => 'required',
                'email' => 'required',
                'budget' => 'required',
                'location' => 'required',
                'timing' => 'required',
            ]);
        }

        // dd($request->all());

        $property = PropertiesModel::where('property_slug', $slug)->first();

        $booking = PropertyLeadsModel::create([
            'properties_id' => $slug == null ? null : $property->id,
            'agent_code' => $slug == null ? null : $property->internal_reference,
            'cust_name' => $request->name,
            'cust_telp' => $request->phone_number,
            'cust_email' => $request->email,
            'cust_budget' => (int)preg_replace('/[^0-9]/', '', $request->budget),
            'require_bedroom' => $slug == null ? null : $request->bedroom,
            'localization' => $request->location,
            'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
            'message' => $request->message,
        ]);

        event(new BookingCreated($booking));

        $flashData = [
            'judul' => 'Form Submit Success',
            'pesan' => 'Thank you, we have received your data.',
            'swalFlashIcon' => 'success',
        ];

        return back()->with('flashData', $flashData);
    }

    public function sendMail(Request $request)
    {
        $data = $request->all();

        $propertyNames = $data['property_name'];
        $sellingPrices = $data['selling_price'];

        $combined = [];

        foreach ($propertyNames as $index => $name) {
            $combined[] = [
                'name' => $name,
                'selling_price' => $sellingPrices[$index],
            ];
        }
        Mail::to($request->cust_email)->send(new NotifikasiEmail([
            'properties' => $combined,
        ]));


        $flashData = [
            'judul' => 'Success',
            'pesan' => 'Recommendation email successfully sent to customer',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('leads.index')->with('flashData', $flashData);
    }
}
