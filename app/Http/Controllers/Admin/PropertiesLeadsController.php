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

    public function searchMatchProperties(Request $request, $leadId)
    {
        $lead = PropertyLeadsModel::findOrFail($leadId);
        $customerLeads = PropertyLeadsModel::where('customer_id', $lead->customer_id)->where('visibility', 1)->get();

        $results = [];

        foreach ($customerLeads as $customerLead) {
            $query = PropertiesModel::join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                ->leftJoin('users', 'users.reference_code', '=', 'properties.internal_reference');

            if ($customerLead->type_asset == 'properties') {
                $query->where('type_properties', 'Properties')
                    ->where('bedroom', '>=', $customerLead->min_bedroom ?? 0)
                    ->when($customerLead->max_bedroom, fn($q) => $q->where('bedroom', '<=', $customerLead->max_bedroom))
                    ->where('sub_region', '=', $customerLead->localization)
                ;
            } elseif ($customerLead->type_asset == 'land') {
                $query->where('type_properties', 'Land')
                    ->where('total_land_area', '>=', $customerLead->min_land_size ?? 0)
                    ->when($customerLead->max_land_size, fn($q) => $q->where('total_land_area', '<=', $customerLead->max_land_size))
                    ->where('sub_region', '=', $customerLead->localization)
                ;
            }

            $results[$customerLead->type_asset] = $query->get();
        }

        $properties = $results;
        return response()->json([
            'lead' => $customerLeads,
            'asset' => $properties
        ]);
    }

    public function getSpecificProperties($customerID)
    {

        $propertiesData  = PropertyLeadsModel::where('customer_id', $customerID)
            ->where('leads.type_asset', 'properties')
            ->join('properties', 'properties.id', '=', 'leads.properties_id')
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->select(
                'leads.customer_id',
                'leads.properties_id',
                'properties.*',
                'property_financial.*',
            )
            ->get();

        $landData  = PropertyLeadsModel::where('customer_id', $customerID)
            ->where('leads.type_asset', 'land')
            ->join('properties', 'properties.id', '=', 'leads.properties_id')
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->select(
                'leads.customer_id',
                'leads.properties_id',
                'properties.*',
                'property_financial.*',
            )
            ->get();
        return response()->json([
            'customerID' => $customerID,
            'propertiesData' => $propertiesData,
            'landData' => $landData
        ]);
    }

    public function index()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 'Master') {

            $data['data_leads'] = PropertyLeadsModel::where('customer.agent_code', '!=', null)
                ->join('customer', 'customer.id', '=', 'leads.customer_id')
                ->join('properties', 'properties.id', '=', 'leads.properties_id')
                ->get()->groupBy('customer_id');
        } else {

            $data['data_leads'] = PropertyLeadsModel::where('customer.agent_code', Auth::user()->reference_code)->where('properties_id', '!=', null)->where('prospect_status', 0)
                ->select(
                    'leads.*',
                    'properties.id as properties_id',
                    'properties.property_name',
                    'properties.property_address',
                    'properties.region',
                    'properties.sub_region',
                    'properties.bedroom',
                    'properties.bathroom',
                )
                ->leftJoin('customer', 'customer.id', '=', 'leads.customer_id')
                ->leftJoin('properties', 'properties.id', '=', 'leads.properties_id')
                ->get()->groupBy('cust_email');
        }

        // dd($data['data_leads']);


        $data['data_localization'] = SubRegionModel::select('name')->get();
        $data['data_agent'] = User::where('role', 'agent')->get();

        $data['data_properties'] = PropertiesModel::where('type_acceptance', 'accept')->get();

        $data['data_leads_matches'] = CustomerDataModel::where('customer.agent_code', null)
            ->join('leads', 'leads.customer_id', '=', 'customer.id')
            ->get()->groupBy('customer_id');

        // dd($data['data_leads_matches']);


        return view('admin.leads.index', $data);
    }


    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $customerID = $id;

        CustomerDataModel::where('id', $customerID)->update([
            'first_name' => $request->customer_first_name,
            'last_name' => $request->customer_last_name,
            'cust_phone' => $request->customer_phone,
            'cust_email' => $request->customer_email,
            'cust_nationality' => $request->customer_nationality,
            'cust_passport' => $request->customer_passport,
        ]);

        PropertyLeadsModel::where('customer_id', $customerID)->where('type_asset', 'villa')->update([
            'min_budget_idr' => (int)preg_replace('/[^0-9]/', '', $request->villa_min_budget_idr),
            'max_budget_idr' => (int)preg_replace('/[^0-9]/', '', $request->villa_max_budget_idr),

            'min_budget_usd' => floatval(preg_replace('/[^\d.]/', '', $request->villa_min_budget_usd)),
            'max_budget_usd' => floatval(preg_replace('/[^\d.]/', '', $request->villa_max_budget_usd)),

            'min_bedroom' => $request->min_bedroom,
            'max_bedroom' => $request->max_bedroom,

            'localization' => $request->villa_localization,
            'date' => Carbon::createFromFormat('d F, Y', $request->ready_buy_villa)->format('Y-m-d'),
            'visibility' => $request->type_properties_villa == null ? 0 : 1,

        ]);

        PropertyLeadsModel::where('customer_id', $customerID)->where('type_asset', 'land')->update([

            'min_budget_idr' => (int)preg_replace('/[^0-9]/', '', $request->land_min_budget_idr),
            'max_budget_idr' => (int)preg_replace('/[^0-9]/', '', $request->land_max_budget_idr),

            'min_budget_usd' => floatval(preg_replace('/[^\d.]/', '', $request->land_min_budget_usd)),
            'max_budget_usd' => floatval(preg_replace('/[^\d.]/', '', $request->land_max_budget_usd)),

            'min_bedroom' => $request->min_land_size,
            'max_bedroom' => $request->max_land_size,

            'localization' => $request->land_localization,
            'date' => Carbon::createFromFormat('d F, Y', $request->ready_buy_villa)->format('Y-m-d'),

            'visibility' => $request->type_properties_land == null ? 0 : 1,
        ]);



        // dd('done update');



        // $propertiesLeads = PropertyLeadsModel::where('id', $id)->first();

        // // Jika ada input property specific
        // $propertiesData = null;
        // if (isset($request->input_specific_properties)) {
        //     $propertiesData = PropertiesModel::where('property_slug', $request->input_specific_properties)->first();
        // }

        // PropertyLeadsModel::where('id', $id)->update([
        //     'properties_id' => $propertiesLeads->properties_id == null ? $propertiesData?->id : $propertiesLeads->properties_id,
        //     'agent_code' => $propertiesLeads->agent_code == null ? $propertiesData?->internal_reference : $propertiesLeads->agent_code,
        //     'cust_budget' => $this->convertToInteger($request->leads_budget),
        //     'localization' => $request->localization,
        // ]);

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
        PropertyLeadsModel::where('customer_id', $id)->delete();

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
