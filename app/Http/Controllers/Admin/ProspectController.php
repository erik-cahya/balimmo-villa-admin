<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\CustomerDataModel;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use App\Models\PropertyProspectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProspectController extends Controller
{

    public function leadsToProspect(Request $request, $id)
    {

        // dd($id);


        // dd($request->all());

        $customerID = $id;

        // Validasi nationality & passport customer
        $dataCustomer = CustomerDataModel::where('id', $customerID)->first();
        if ($dataCustomer->cust_nationality == null) {
            $flashData = [
                'judul' => 'Nationality data is empty',
                'pesan' => 'Please input nationality in "make prospect"',
                'swalFlashIcon' => 'error',
            ];
            return back()->with('flashData', $flashData);
        }
        if ($dataCustomer->cust_passport == null) {
            $flashData = [
                'judul' => 'Passport data is empty',
                'pesan' => 'Please input passport in "make prospect"',
                'swalFlashIcon' => 'error',
            ];
            return back()->with('flashData', $flashData);
        }

        // foreach ($request->properties_name as $propeties => $value) {
        //     dd($propeties);
        // };

        // Pindahkan data dari table leads ke prospect
        $dataLeads = PropertyLeadsModel::where('customer_id', $customerID)->get();
        foreach ($dataLeads as $lead) {
            PropertyProspectModel::create([
                'customer_id' => $lead->customer_id,
                'type_asset' => $lead->type_asset,
                'min_budget_idr' => $lead->min_budget_idr,
                'max_budget_idr' => $lead->max_budget_idr,
                'min_budget_usd' => $lead->min_budget_usd,
                'max_budget_usd' => $lead->max_budget_usd,
                'min_bedroom' => $lead->min_bedroom,
                'max_bedroom' => $lead->max_bedroom,
                'min_land_size' => $lead->min_land_size,
                'max_land_size' => $lead->max_land_size,
                'localization' => $lead->localization,
                'date' => $lead->date,
            ]);
        }
        PropertyLeadsModel::where('customer_id', $customerID)->delete();


        CustomerDataModel::where('id', $customerID)->update([
            'agent_code' => $request->agent_code
        ]);

        dd('data dipindah dan masuk ke prospect');


        if ($request->status_prospect == 'No') {
            $flashData = [
                'judul' => 'Prospect Change Cancelled',
                'pesan' => 'Leads cancelled into prospects',
                'swalFlashIcon' => 'error',
            ];
            return back()->with('flashData', $flashData);
        }

        $status_prospect = PropertyLeadsModel::where('id', $id)->first();


        // dd($status_prospect->properties_id);

        if ($status_prospect->properties_id == null) {

            $internalReference = PropertiesModel::where('id', $request->selected_properties_id)->select('id', 'internal_reference')->first();

            if (!isset($internalReference->id)) {
                $flashData = [
                    'judul' => 'Prospect Change Cancelled',
                    'pesan' => 'Please select the properties to assign',
                    'swalFlashIcon' => 'error',
                ];
                return back()->with('flashData', $flashData);
            }
            // Cek apakah data leads sudah diambil atau belum
            if ($status_prospect->agent_code == null) {
                PropertyLeadsModel::where('id', $id)->update([
                    'properties_id' => $internalReference->id,
                    'agent_code' => $internalReference->internal_reference,
                    'prospect_status' => 1
                ]);

                $flashData = [
                    'judul' => 'Prospect Change Success',
                    'pesan' => 'Leads success change into prospects',
                    'swalFlashIcon' => 'success',
                ];
                return back()->with('flashData', $flashData);
            } else {
                $flashData = [
                    'judul' => 'Prospect failed to update',
                    'pesan' => 'Prospect data has been taken',
                    'swalFlashIcon' => 'error',
                ];
                return back()->with('flashData', $flashData);
            }
        } else {

            PropertyLeadsModel::where('cust_email', $status_prospect->cust_email)->update([
                'prospect_status' => 1
            ]);

            $flashData = [
                'judul' => 'Leads Change to Prospect',
                'pesan' => 'Leads Data Changed Successfully',
                'swalFlashIcon' => 'success',
            ];
            return back()->with('flashData', $flashData);
        }
    }

    public function index()
    {
        return view('admin.prospect.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function bck_index()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }


        if (Auth::user()->role == 'Master') {
            $data['data_leads'] = PropertyLeadsModel::where('agent_code', '!=', null)->where('properties_id', '!=', null)->where('prospect_status', 1)
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
            $data['data_leads'] = PropertyLeadsModel::where('agent_code', Auth::user()->reference_code)->where('properties_id', '!=', null)->where('prospect_status', 1)
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

        $data['data_leads_matches'] = PropertyLeadsModel::where('agent_code', null)->select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
            ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
            ->get();


        $leads = $data['data_leads_matches'];
        $data['matchProperties'] = [];

        if ($leads->isNotEmpty()) {
            // Ambil semua lokasi & budget maksimum
            $regions = $leads->pluck('localization')->unique()->toArray();
            $maxBudgetIdr = $leads->max('cust_budget');
            $maxBudgetUsd = $leads->max('cust_budget_usd');

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
                        // Jika sebelumnya sudah ada kondisi (dari IDR), gunakan orWhere
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

            // Kelompokkan kembali sesuai budget masing-masing lead
            foreach ($leads as $lead) {
                $regionProps = $groupedProperties[$lead->localization] ?? collect();

                $data['matchProperties'][$lead->id] = $regionProps->filter(function ($property) use ($lead) {
                    return (
                        ($property->selling_price_idr !== null && $property->selling_price_idr <= $lead->cust_budget) ||
                        ($property->selling_price_usd !== null && $property->selling_price_usd <= $lead->cust_budget_usd)
                    );
                })->values(); // reset index
            }
        } else {
            // Kosongkan jika tidak ada leads
            $data['matchProperties'] = [];
        }

        // dd($data['matchProperties']);

        return view('admin.prospect.index', $data);
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
    public function store(Request $request)
    {
        //
    }

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
}
