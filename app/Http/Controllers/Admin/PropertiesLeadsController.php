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

    public function leadsUpdate(Request $request, $leadId)
    {
        $lead = PropertyLeadsModel::findOrFail($leadId);




        // $properties = PropertiesModel::join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
        //     ->where('type_properties', 'Land')
        //     ->where('total_land_area', '>=', $lead->min_land_size)
        //     ->when($lead->max_land_size, function ($query) use ($lead) {
        //         return $query->where('total_land_area', '<=', $lead->max_land_size);
        //     })
        //     ->get();

        // $properties = PropertiesModel::join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
        //     ->where('type_properties', 'Properties')
        //     ->where('bedroom', '>=', $lead->min_bedroom)
        //     ->when($lead->max_bedroom, function ($query) use ($lead) {
        //         return $query->where('bedroom', '<=', $lead->max_bedroom);
        //     })
        //     ->get();


        $customerLeads = PropertyLeadsModel::where('customer_id', $lead->customer_id)->get();

        $results = [];

        foreach ($customerLeads as $customerLead) {
            $query = PropertiesModel::join('property_financial', 'property_financial.properties_id', '=', 'properties.id');

            if ($customerLead->type_asset == 'villa') {
                $query->where('type_properties', 'Properties')
                    ->where('bedroom', '>=', $customerLead->min_bedroom ?? 0)
                    ->when($customerLead->max_bedroom, fn($q) => $q->where('bedroom', '<=', $customerLead->max_bedroom));
            } elseif ($customerLead->type_asset == 'land') {
                $query->where('type_properties', 'Land')
                    ->where('total_land_area', '>=', $customerLead->min_land_size ?? 0)
                    ->when($customerLead->max_land_size, fn($q) => $q->where('total_land_area', '<=', $customerLead->max_land_size));
            }

            $results[$customerLead->type_asset] = $query->get();
        }

        $properties = $results;
        // $results akan berisi:
        // [
        //     'villa' => [collection of villa properties],
        //     'land' => [collection of land properties]
        // ]

        return response()->json([
            'lead' => $customerLeads,
            'properties' => $properties
        ]);
    }

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


        $data['data_localization'] = SubRegionModel::select('name')->get();
        $data['data_agent'] = User::where('role', 'agent')->get();

        $data['data_properties'] = PropertiesModel::where('type_acceptance', 'accept')->get();


        // Data Tabel Leads Match
        // $data['data_leads_matches'] = PropertyLeadsModel::where('customer_data.agent_code', null)

        //     ->join('customer_data', 'customer_data.id', '=', 'property_leads.customer_id')
        //     // ->join('properties', 'properties.id', '=', 'property_leads.properties_id')
        //     ->get()->groupBy('customer_id');

        $data['data_leads_matches'] = CustomerDataModel::where('customer_data.agent_code', null)
            ->join('property_leads', 'property_leads.customer_id', '=', 'customer_data.id')
            ->get()->groupBy('customer_id');

        // dd($data['data_leads_matches']);


        return view('admin.leads.index', $data);



        // dd([
        //     'min_bedroom' => $lead->min_bedroom,
        //     'max_bedroom' => $lead->max_bedroom,
        //     'min_budget' => $lead->min_budget_idr,
        //     'max_budget' => $lead->max_budget_idr
        // ]);

        $properties = PropertiesModel::where('bedroom', '>=', $lead->min_bedroom)
            ->when($lead->max_bedroom, function ($query) use ($lead) {
                return $query->where('bedroom', '<=', $lead->max_bedroom);
            })

            ->where('selling_price_idr', '>=', $lead->min_budget_idr)
            ->when($lead->max_budget_idr, function ($query) use ($lead) {
                return $query->where('selling_price_idr', '<=', $lead->max_budget_idr);
            })

            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->get();

        $data['matchProperties'] = $properties;

        dd($data['matchProperties']);

        // return view('admin.leads.index', $data);
    }

    public function getMatchingProperties(Request $request, $leadId)
    {
        $lead = PropertyLeadsModel::findOrFail($leadId);

        $properties = PropertiesModel::where('bedroom', '>=', $lead->min_bedroom)
            ->when($lead->max_bedroom, function ($query) use ($lead) {
                return $query->where('bedroom', '<=', $lead->max_bedroom);
            })
            ->where('selling_price', '>=', $lead->min_budget)
            ->when($lead->max_budget, function ($query) use ($lead) {
                return $query->where('selling_price', '<=', $lead->max_budget);
            })
            ->get();

        return response()->json([
            'lead' => $lead,
            'properties' => $properties
        ]);
    }

    public function update(Request $request, string $id)
    {
        // dd($request->type_properties_land);
        // dd($request->all());

        $customerID = $id;

        CustomerDataModel::where('id', $customerID)->update([
            'first_name' => $request->customer_first_name,
            'last_name' => $request->customer_last_name,
            'cust_phone' => $request->customer_phone,
            'cust_email' => $request->customer_email,
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





    public function index_backupp()
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


        $data['data_localization'] = SubRegionModel::select('name')->get();
        $data['data_agent'] = User::where('role', 'agent')->get();

        $data['data_properties'] = PropertiesModel::where('type_acceptance', 'accept')->get();


        // Data Tabel Leads Match
        $data['data_leads_matches'] = PropertyLeadsModel::where('customer_data.agent_code', null)
            ->join('customer_data', 'customer_data.id', '=', 'property_leads.customer_id')
            // ->join('properties', 'properties.id', '=', 'property_leads.properties_id')
            ->get()->groupBy('customer_id');

        $leads = $data['data_leads_matches'];
        $data['matchProperties'] = [];

        if ($leads->isNotEmpty()) {
            $regions = $leads->flatMap(function ($group) {
                return $group->pluck('localization');
            })->unique()->toArray();

            $maxBudgetIdr = $leads->flatMap(function ($group) {
                return $group->pluck('max_budget_idr');
            })->max();

            $maxBudgetUsd = $leads->flatMap(function ($group) {
                return $group->pluck('max_budget_usd');
            })->max();

            $properties = PropertiesModel::whereIn('sub_region', $regions)
                ->with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'property_gallery.id')->where('is_featured', 1);
                }])
                ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                ->where(function ($query) use ($maxBudgetIdr, $maxBudgetUsd) {
                    if (!is_null($maxBudgetIdr)) {
                        $query->where('selling_price_idr', '<=', $maxBudgetIdr);
                    }

                    if (!is_null($maxBudgetUsd)) {
                        $query->orWhere('selling_price_usd', '<=', $maxBudgetUsd);
                    }
                })
                ->get();

            $groupedProperties = $properties->groupBy('sub_region');


            $data['matchProperties'] = [];

            foreach ($leads as $group) {
                foreach ($group as $leadItem) {
                    $regionProps = $groupedProperties[$leadItem->localization] ?? collect();

                    $matched = $regionProps->filter(function ($property) use ($leadItem) {
                        // Validasi harga
                        $validPrice = (
                            (!is_null($property->selling_price_idr) && $property->selling_price_idr <= $leadItem->max_budget_idr) ||
                            (!is_null($property->selling_price_usd) && $property->selling_price_usd <= $leadItem->max_budget_usd)
                        );

                        // Validasi type_asset
                        $validAsset = true;
                        if ($leadItem->type_asset === 'villa') {
                            $validAsset = (
                                (!is_null($leadItem->min_bedroom) && $property->bedroom >= $leadItem->min_bedroom) &&
                                (!is_null($leadItem->max_bedroom) && $property->bedroom <= $leadItem->max_bedroom)
                            );
                        } elseif ($leadItem->type_asset === 'land') {
                            $validAsset = (
                                (!is_null($leadItem->min_land_size) && $property->total_land_area >= $leadItem->min_land_size) &&
                                (!is_null($leadItem->max_land_size) && $property->total_land_area <= $leadItem->max_land_size)
                            );
                        }

                        return $validPrice && $validAsset;
                    })->values();

                    // Simpan berdasarkan ID lead
                    $data['matchProperties'][$leadItem->id] = $matched;
                }
            }
        } else {
            $data['matchProperties'] = [];
        }





        return view('admin.leads.index', $data);
    }
}
