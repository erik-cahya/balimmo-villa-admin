<?php

namespace App\Http\Controllers\Admin;

use App\Events\BookingCreated;
use App\Http\Controllers\Controller;
use App\Mail\NotifikasiEmail;
use App\Models\CustomerDataModel;
use App\Models\Land\LandModel;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use App\Models\SubRegionModel;
use App\Models\User;
use App\Services\LeadsService;
use App\Services\ProspectService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PropertiesLeadsController extends Controller
{

    protected $leads_service;
    protected $prospect_service;

    public function __construct()
    {
        $this->leads_service = new LeadsService();
        $this->prospect_service = new ProspectService();
    }

    public function searchMatchProperties(Request $request, $leadId)
    {
        $lead = PropertyLeadsModel::findOrFail($leadId);
        $customerLeads = PropertyLeadsModel::where('customer_id', $lead->customer_id)->where('visibility', 1)->get();

        $results = [];

        foreach ($customerLeads as $customerLead) {
            $user = Auth::user();

            if ($customerLead->type_asset == 'properties') {
                $query = PropertiesModel::join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                    ->leftJoin('users', 'users.reference_code', '=', 'properties.internal_reference')
                    ->where('bedroom', '>=', $customerLead->min_bedroom ?? 0)
                    ->when($customerLead->max_bedroom, fn($q) => $q->where('bedroom', '<=', $customerLead->max_bedroom))
                    ->where('area', '=', $customerLead->localization);

                if ($user->role == 'agent') {
                    $query->where('properties.internal_reference', $user->reference_code);
                }
            } elseif ($customerLead->type_asset == 'land') {
                $query = LandModel::join('land_financial', 'land_financial.land_id', '=', 'land.id')
                    ->leftJoin('users', 'users.reference_code', '=', 'land.internal_reference')
                    ->where('total_land_area', '>=', $customerLead->min_land_size ?? 0)
                    ->when($customerLead->max_land_size, fn($q) => $q->where('total_land_area', '<=', $customerLead->max_land_size))
                    ->where('area', '=', $customerLead->localization);

                if ($user->role == 'agent') {
                    $query->where('land.internal_reference', $user->reference_code);
                }
            }

            $results[$customerLead->type_asset] = $query->get();
        }

        return response()->json([
            'lead' => $customerLeads,
            'asset' => $results,
            'id' => $lead->customer_id
        ]);
    }

    public function getSpecificProperties($customerID)
    {
        $user = Auth::user(); // ambil user yang sedang login

        // Base query untuk properties
        $propertiesQuery = PropertyLeadsModel::where('customer_id', $customerID)
            ->where('leads.type_asset', 'properties')
            ->join('properties', 'properties.id', '=', 'leads.properties_id')
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->select(
                'leads.customer_id',
                'leads.properties_id',
                'properties.*',
                'property_financial.*',
            );

        // Base query untuk land
        $landQuery = PropertyLeadsModel::where('customer_id', $customerID)
            ->where('leads.type_asset', 'land')
            ->join('land', 'land.id', '=', 'leads.land_id')
            ->join('land_financial', 'land_financial.land_id', '=', 'land.id')
            ->select(
                'leads.customer_id',
                'leads.land_id',
                'land.*',
                'land_financial.*',
            );

        // Jika role-nya agent, batasi berdasarkan reference_code
        if ($user->role === 'agent') {
            $propertiesQuery->where('properties.internal_reference', $user->reference_code);
            $landQuery->where('land.internal_reference', $user->reference_code);
        }

        return response()->json([
            'customerID' => $customerID,
            'propertiesData' => $propertiesQuery->get(),
            'landData' => $landQuery->get()
        ]);
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 'master') {
            $data['data_leads'] = PropertyLeadsModel::where('customer.agent_code', '!=', null)
                ->join('customer', 'customer.id', '=', 'leads.customer_id')
                ->get()->groupBy('customer_id');
        } else {
            // dd(Auth::user()->reference_code);
            $data['data_leads'] = PropertyLeadsModel::where('customer.agent_code', Auth::user()->reference_code)
                ->leftJoin('customer', 'customer.id', '=', 'leads.customer_id')
                ->get()->groupBy('customer_id');
        }

        // dd($data['data_leads']);

        $data['data_localization'] = SubRegionModel::select('name')->get();
        $data['data_agent'] = User::get();

        // dd($data['data_agent']);

        $data['data_properties'] = PropertiesModel::where('type_acceptance', 'accept')->get();

        $data['data_leads_matches'] = CustomerDataModel::where('customer.agent_code', null)
            ->join('leads', 'leads.customer_id', '=', 'customer.id')
            ->get()->groupBy('customer_id');

        // dd($data['data_leads_matches']);


        return view('admin.leads.index', $data);
    }


    public function update(Request $request, string $id)
    {
        $customerID = $id;

        CustomerDataModel::where('id', $customerID)->update([
            'first_name' => $request->customer_first_name,
            'last_name' => $request->customer_last_name,
            'cust_phone' => $request->customer_phone,
            'cust_email' => $request->customer_email,
            'cust_nationality' => $request->customer_nationality,
            'cust_passport' => $request->customer_passport,
        ]);

        $dataLeads = collect();
        $dataLeads->add([
            'type_asset'  => 'properties',
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
        $dataLeads->add([
            'type_asset'  => 'land',
            'min_budget_idr' => (int)preg_replace('/[^0-9]/', '', $request->land_min_budget_idr),
            'max_budget_idr' => (int)preg_replace('/[^0-9]/', '', $request->land_max_budget_idr),

            'min_budget_usd' => floatval(preg_replace('/[^\d.]/', '', $request->land_min_budget_usd)),
            'max_budget_usd' => floatval(preg_replace('/[^\d.]/', '', $request->land_max_budget_usd)),

            'min_land_size' => $request->min_land_size,
            'max_land_size' => $request->max_land_size,

            'localization' => $request->land_localization,
            'date' => Carbon::createFromFormat('d F, Y', $request->ready_buy_villa)->format('Y-m-d'),

            'visibility' => $request->type_properties_land == null ? 0 : 1,
        ]);

        $leads = $this->leads_service->updateOrCreateLeads($customerID, $dataLeads);
        $prospects = $this->prospect_service->createNewProspect($customerID, $leads);




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

    public function changeAgent(Request $request , string $id)
    {
        $lead = PropertyLeadsModel::find($id);

        $lead->customer()->update([
            'agent_code' => $request->get('agent_code')
        ]);

        $flashData = [
            'judul' => 'Success',
            'pesan' => 'Agent changed sucessfully',
            'swalFlashIcon' => 'success',
        ];
        

        return response()->json($flashData);
    }

    private function convertToInteger($value)
    {
        return (int)preg_replace('/[^0-9]/', '', $value);
    }
}
