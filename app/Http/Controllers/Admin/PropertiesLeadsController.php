<?php

namespace App\Http\Controllers\Admin;

use App\Events\BookingCreated;
use App\Http\Controllers\Controller;
use App\Mail\NotifikasiEmail;
use App\Models\CustomerDataModel;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use App\Models\SubRegionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PropertiesLeadsController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }


        if (Auth::user()->role == 'Master') {

            $data['data_leads'] = PropertyLeadsModel::where('customer_data.agent_code', '!=', null)
                ->join('customer_data', 'customer_data.id', '=', 'property_leads.customer_id')
                ->join('properties', 'properties.id', '=', 'property_leads.properties_id')
                ->get();
        } else {

            $data['data_leads'] = PropertyLeadsModel::where('agent_code', Auth::user()->reference_code)->where('properties_id', '!=', null)->where('prospect_status', 0)
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

        // $data['data_leads_matches'] = PropertyLeadsModel::where('customer_data.agent_code', null)
        //     ->join('customer_data', 'customer_data.id', '=', 'property_leads.customer_id')
        //     // ->join('properties', 'properties.id', '=', 'property_leads.properties_id')
        //     ->get();

        $data['data_leads_matches'] = PropertyLeadsModel::where('customer_data.agent_code', null)
            ->join('customer_data', 'customer_data.id', '=', 'property_leads.customer_id')
            // ->join('properties', 'properties.id', '=', 'property_leads.properties_id')
            ->get()->groupBy('customer_id');

        // dd($data['data_leads_matches']);

        $leads = $data['data_leads_matches'];
        $data['matchProperties'] = [];

        if ($leads->isNotEmpty()) {
            // Ambil semua lokasi & budget maksimum
            $regions = $leads->flatten()->pluck('localization')->unique()->toArray(); // gunakan flatten
            $maxBudgetIdr = $leads->flatten()->max('cust_budget');
            $maxBudgetUsd = $leads->flatten()->max('cust_budget_usd');

            // Ambil semua properti yang mungkin cocok
            $properties = PropertiesModel::whereIn('sub_region', $regions)
                ->with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'property_gallery.id');
                    $query->where('is_featured', 1);
                }])
                ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                ->where(function ($query) use ($maxBudgetIdr, $maxBudgetUsd) {
                    if (!is_null($maxBudgetIdr)) {
                        $query->where('selling_price_idr', '<=', $maxBudgetIdr);
                    }

                    if (!is_null($maxBudgetUsd)) {
                        if (!is_null($maxBudgetIdr)) {
                            $query->orWhere('selling_price_usd', '<=', $maxBudgetUsd);
                        } else {
                            $query->where('selling_price_usd', '<=', $maxBudgetUsd);
                        }
                    }
                })
                ->get();

            // Kelompokkan properti berdasarkan region
            $groupedProperties = $properties->groupBy('sub_region');

            // Proses tiap lead di setiap group
            foreach ($leads as $groupedLeads) {
                foreach ($groupedLeads as $lead) {
                    $regionProps = $groupedProperties[$lead->localization] ?? collect();

                    $data['matchProperties'][$lead->id] = $regionProps->filter(function ($property) use ($lead) {
                        return (
                            ($property->selling_price_idr !== null && $property->selling_price_idr <= $lead->cust_budget) ||
                            ($property->selling_price_usd !== null && $property->selling_price_usd <= $lead->cust_budget_usd)
                        );
                    })->values();
                }
            }
        } else {
            $data['matchProperties'] = [];
        }


        $data['data_localization'] = SubRegionModel::select('name')->get();
        $data['data_agent'] = User::where('role', 'agent')->get();

        $data['data_properties'] = PropertiesModel::where('type_acceptance', 'accept')->get();

        // dd($data['matchProperties']);

        return view('admin.leads.index', $data);
    }


    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $customerID = $id;

        $fullName = $request->customer_name;
        $nameParts = explode(' ', $fullName);
        $firstName = array_shift($nameParts);
        $lastName = implode(' ', $nameParts);


        CustomerDataModel::where('id', $customerID)->update([
            'first_name' => $firstName,
            'last_name' => empty($lastName) ? NULL : $lastName,
            'cust_phone' => $request->customer_phone,
            'cust_email' => $request->customer_email,
        ]);

        dd('done update');

        $propertiesLeads = PropertyLeadsModel::where('id', $id)->first();

        // Jika ada input property specific
        $propertiesData = null;
        if (isset($request->input_specific_properties)) {
            $propertiesData = PropertiesModel::where('property_slug', $request->input_specific_properties)->first();
        }

        PropertyLeadsModel::where('id', $id)->update([
            'properties_id' => $propertiesLeads->properties_id == null ? $propertiesData?->id : $propertiesLeads->properties_id,
            'agent_code' => $propertiesLeads->agent_code == null ? $propertiesData?->internal_reference : $propertiesLeads->agent_code,
            'cust_budget' => $this->convertToInteger($request->leads_budget),
            'localization' => $request->localization,
        ]);

        $flashData = [
            'judul' => 'Success',
            'pesan' => 'Data Leads Successfully Update',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('leads.index')->with('flashData', $flashData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteSingle(string $id)
    {
        PropertyLeadsModel::where('id', $id)->delete();

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Delete Leads Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }

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

    // public function booking(Request $request, $slug = null)
    // {
    //     // dd($request->all());

    //     // dd($request->all());
    //     if ($slug !== null) {
    //         $request->validate([
    //             'name' => 'required',
    //             'phone_number' => 'required',
    //             'email' => 'required',
    //             // 'budget' => 'required',
    //             'timing' => 'required',
    //             'bedroom' => 'required',
    //         ]);
    //     } else {
    //         // Form di landing page
    //         $request->validate([
    //             'name' => 'required',
    //             'phone_number' => 'required',
    //             'email' => 'required',
    //             // 'budget' => 'required',
    //             'location' => 'required',
    //             'timing' => 'required',
    //         ]);
    //     }

    //     if ($request->budget_currency == 'idr') {
    //         $custBudgetIDR = (int)preg_replace('/[^0-9]/', '', $request->budget_idr);
    //         $custBudgetUSD = null;
    //     } else {
    //         $custBudgetIDR = null;
    //         $custBudgetUSD = floatval(preg_replace('/[^\d.]/', '', $request->budget_usd));
    //     }


    //     $property = PropertiesModel::where('property_slug', $slug)->first();

    //     $booking = PropertyLeadsModel::create([
    //         'properties_id' => $slug == null ? null : $property->id,
    //         'agent_code' => $slug == null ? null : $property->internal_reference,
    //         'cust_name' => $request->name,
    //         'cust_telp' => $request->phone_number,
    //         'cust_email' => $request->email,
    //         'cust_budget' => $custBudgetIDR,
    //         'cust_budget_usd' => $custBudgetUSD,
    //         'require_bedroom' => $slug == null ? null : $request->bedroom,
    //         'localization' => $request->location == null ? $property->sub_region : $request->location,
    //         'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
    //         'message' => $request->message,
    //         'prospect_status' => 0
    //     ]);

    //     // Form di landing page
    //     if ($slug === null) {
    //         // dd($booking->id);

    //         $data['data_leads_matches'] = PropertyLeadsModel::where('property_leads.id', $booking->id)->select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
    //             ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
    //             ->get();

    //         // dd($data['data_leads_matches']);

    //         $leads = $data['data_leads_matches'];
    //         $data['matchProperties'] = collect();

    //         if ($leads->isNotEmpty()) {
    //             // Ambil semua lokasi & budget maksimum
    //             $regions = $leads->pluck('localization')->unique()->toArray();
    //             $maxBudgetIdr = $leads->max('cust_budget');
    //             $maxBudgetUsd = $leads->max('cust_budget_usd');

    //             // Ambil semua properti yang mungkin cocok
    //             $properties = PropertiesModel::whereIn('sub_region', $regions)
    //                 ->with(['featuredImage' => function ($query) {
    //                     $query->select('image_path', 'property_gallery.id');
    //                     $query->where('is_featured', 1);
    //                 }])
    //                 ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
    //                 ->where(function ($query) use ($maxBudgetIdr, $maxBudgetUsd) {
    //                     if (!is_null($maxBudgetIdr)) {
    //                         $query->where('selling_price_idr', '<=', $maxBudgetIdr);
    //                     }

    //                     if (!is_null($maxBudgetUsd)) {
    //                         // Jika sebelumnya sudah ada kondisi (dari IDR), gunakan orWhere
    //                         if (!is_null($maxBudgetIdr)) {
    //                             $query->orWhere('selling_price_usd', '<=', $maxBudgetUsd);
    //                         } else {
    //                             $query->where('selling_price_usd', '<=', $maxBudgetUsd);
    //                         }
    //                     }
    //                 })
    //                 ->get();

    //             // Kelompokkan properti berdasarkan region
    //             $groupedProperties = $properties->groupBy('sub_region');

    //             // Kelompokkan kembali sesuai budget masing-masing lead
    //             foreach ($leads as $lead) {
    //                 $regionProps = $groupedProperties[$lead->localization] ?? collect();

    //                 $data['matchProperties'][$lead->id] = $regionProps->filter(function ($property) use ($lead) {
    //                     return (
    //                         ($property->selling_price_idr !== null && $property->selling_price_idr <= $lead->cust_budget) ||
    //                         ($property->selling_price_usd !== null && $property->selling_price_usd <= $lead->cust_budget_usd)
    //                     );
    //                 })->values(); // reset index
    //             }

    //             $emailTo = $request->email;

    //             Mail::to($emailTo)->send(new NotifikasiEmail([
    //                 'properties' => $data['matchProperties'],
    //             ]));
    //         } else {
    //             // Kosongkan jika tidak ada leads
    //             $data['matchProperties'] = collect();

    //             $emailTo = $request->email;

    //             Mail::to($emailTo)->send(new NotifikasiEmail([
    //                 'properties' => $data['matchProperties'],
    //             ]));
    //         }
    //         // dd($data['matchProperties']);

    //         return view('error.thankyou-page');
    //     }

    //     // event(new BookingCreated($booking));


    //     return view('error.thankyou-page');
    // }

    public function sendMail(Request $request)
    {
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

    private function convertToInteger($value)
    {
        return (int)preg_replace('/[^0-9]/', '', $value);
    }
}
