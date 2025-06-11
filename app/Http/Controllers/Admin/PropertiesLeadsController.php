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

        // if (Auth::user()->role == 'Master') {
        //     $data['data_leads'] = PropertyLeadsModel::select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
        //         ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
        //         ->get();
        // } else {
        //     $data['data_leads'] = PropertyLeadsModel::where('property_leads.agent_code', Auth::user()->reference_code)
        //         ->select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
        //         ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
        //         ->get();
        // }

        if (Auth::user()->role == 'Master') {
            $data['data_leads'] = PropertyLeadsModel::where('agent_code', '!=', null)
                ->select(
                    'property_leads.*',
                    'properties.id as properties_id',
                    'properties.property_name',
                    'properties.property_address',
                    'properties.region',
                    'properties.sub_region',
                    'properties.bedroom',
                    'properties.bathroom',
                )
                ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
                ->get()->groupBy('cust_email');
        } else {
            $data['data_leads'] = PropertyLeadsModel::where('agent_code', Auth::user()->reference_code)
                ->select(
                    'property_leads.*',
                    'properties.id as properties_id',
                    'properties.property_name',
                    'properties.property_address',
                    'properties.region',
                    'properties.sub_region',
                    'properties.bedroom',
                    'properties.bathroom',
                )
                ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
                ->get()->groupBy('cust_email');
        }

        // $data['group'] = PropertyLeadsModel::where('agent_code', Auth::user()->reference_code)->select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
        //     ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
        //     ->get()->groupBy('email');;

        // dd($data['group']);




        $data['data_leads_matches'] = PropertyLeadsModel::where('agent_code', null)->select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
            ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
            ->get();


        $leads = $data['data_leads_matches'];
        $data['matchProperties'] = [];

        if ($leads->isNotEmpty()) {
            // Ambil semua lokasi & budget maksimum
            $regions = $leads->pluck('localization')->unique()->toArray();
            $maxBudget = $leads->max('cust_budget');

            // dd($regions);
            // Ambil semua properti yang mungkin cocok sekaligus
            $properties = PropertiesModel::whereIn('sub_region', $regions)
                ->with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'property_gallery.id');
                    $query->where('is_featured', 1);
                }])
                ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                ->where('selling_price_idr', '<=', $maxBudget)
                ->get();

            // Kelompokkan properti berdasarkan region
            $groupedProperties = $properties->groupBy('sub_region');

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

        // dd($data['matchProperties']);

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

        PropertyLeadsModel::where('cust_email', $id)->delete();

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Delete Leads Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }

    public function booking(Request $request, $slug = null)
    {


        if ($slug !== null) {
            $request->validate([
                'name' => 'required',
                'phone_number' => 'required',
                'email' => 'required',
                'budget' => 'required',
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
            'localization' => $request->location == null ? $property->sub_region : $request->location,
            'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
            'message' => $request->message,
        ]);

        // event(new BookingCre ated($booking));

        $flashData = [
            'judul' => 'Form Submit Success',
            'pesan' => 'Thank you, we have received your data.',
            'swalFlashIcon' => 'success',
        ];

        return back()->with('flashData', $flashData);
    }

    public function sendMail(Request $request)
    {
        // dd($request->cust_email);
        $data = $request->all();

        $propertyNames = $data['property_name'];
        $sellingPricesIDR = $data['selling_price_idr'];
        $sellingPricesUSD = $data['selling_price_usd'];
        $propertyAddress = $data['property_address'];
        $bedroom = $data['bedroom'];
        $bathroom = $data['bathroom'];
        $subRegion = $data['sub_region'];
        $propertySlug = $data['property_slug'];
        $imagePath = $data['image_path'];

        $combined = [];

        foreach ($propertyNames as $index => $name) {
            $combined[] = [
                'name' => $name,
                'sellingPriceIDR' => $sellingPricesIDR[$index],
                'sellingPriceUSD' => $sellingPricesUSD[$index],
                'propertyAddress' => $propertyAddress[$index],
                'bedroom' => $bedroom[$index],
                'bathroom' => $bathroom[$index],
                'subRegion' => $subRegion[$index],
                'propertySlug' => $propertySlug[$index],
                'imagePath' => $imagePath[$index],
            ];
        }


        // $data['properties'] = $combined;
        // return view('emails.notifikasi', $data);


        // Mail::to('erikcp38@gmail.com')->send(new NotifikasiEmail([
        Mail::to($request->cust_email)->send(new NotifikasiEmail([
            'properties' => $combined,
        ]));

        $flashData = [
            'judul' => 'Success',
            'pesan' => 'Recommendation email successfully sent to ' . $request->cust_email,
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('leads.index')->with('flashData', $flashData);
    }
}
