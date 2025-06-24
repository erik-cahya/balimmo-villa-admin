<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use App\Models\PropertyProspectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProspectController extends Controller
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

    public function leadsToProspect(Request $request, $id)
    {
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
}
