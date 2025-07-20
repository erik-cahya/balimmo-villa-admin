<?php

namespace App\Http\Controllers;

use App\Models\CustomerDataModel;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiEmail;


class BookingController extends Controller
{
    public function booking(Request $request, $slug = NULL)
    {
        // if ($slug !== NULL) {
        //     $request->validate([
        //         'first_name' => 'required',
        //         'phone_number' => 'required',
        //         'email' => 'required',
        //         'timing' => 'required',
        //         'bedroom' => 'required',
        //     ]);
        // } else {
        //     // Form di landing page
        //     $request->validate([
        //         'first_name' => 'required',
        //         'phone_number' => 'required',
        //         'email' => 'required',
        //         'location' => 'required',
        //         'timing' => 'required',
        //     ]);
        // }

        // IDR / USD Budget
        if ($request->budget_currency == 'idr') {
            $minimumBudgetIDR = (int)preg_replace('/[^0-9]/', '', $request->minimum_budget_idr);
            $maximumBudgetIDR = (int)preg_replace('/[^0-9]/', '', $request->maximum_budget_idr);
            $minimumBudgetUSD = NULL;
            $maximumBudgetUSD = NULL;
        } else {
            $minimumBudgetIDR = NULL;
            $maximumBudgetIDR = NULL;
            $minimumBudgetUSD = floatval(preg_replace('/[^\d.]/', '', $request->minimum_budget_usd));
            $maximumBudgetUSD = floatval(preg_replace('/[^\d.]/', '', $request->maximum_budget_usd));
        }

        $property = PropertiesModel::where('property_slug', $slug)->first();

        $newCustomerData = CustomerDataModel::create([
            'agent_code' => $slug == NULL ? NULL : $property->internal_reference,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cust_phone' => $request->phone_number,
            'cust_email' => $request->email
        ]);


        $bedroom_min = $request->bedroom_min;
        $bedroom_max = $request->bedroom_max;
        $land_size_min = $request->land_size_min;
        $land_size_max = $request->land_size_max;

        if ($request->type_asset_villa == null) {
            $bedroom_min = NULL;
            $bedroom_max = NULL;
        } elseif ($request->type_asset_land == null) {
            $land_size_min = NULL;
            $land_size_max = NULL;
        }

        // Jika type asset villa dipilih
        if ($request->type_asset_villa !== null) {
            $leadsData = PropertyLeadsModel::create([
                'properties_id' => $slug == NULL ? NULL : $property->id,
                'customer_id' => $newCustomerData->id,
                'type_asset' => $request->type_asset_villa,

                'min_budget_idr' => $minimumBudgetIDR,
                'max_budget_idr' => $maximumBudgetIDR,
                'min_budget_usd' => $minimumBudgetUSD,
                'max_budget_usd' => $maximumBudgetUSD,

                'min_bedroom' => $bedroom_min,
                'max_bedroom' => $bedroom_max,

                'localization' => $request->location == NULL ? $property->sub_region : $request->location,
                'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
                'message' => $request->message,
                'prospect_status' => 0
            ]);
        }
        // Jika type asset land dipilih
        if ($request->type_asset_land !== null) {
            $leadsData = PropertyLeadsModel::create([
                'properties_id' => $slug == NULL ? NULL : $property->id,
                'customer_id' => $newCustomerData->id,
                'type_asset' => $request->type_asset_land,

                'min_budget_idr' => $minimumBudgetIDR,
                'max_budget_idr' => $maximumBudgetIDR,
                'min_budget_usd' => $minimumBudgetUSD,
                'max_budget_usd' => $maximumBudgetUSD,

                'min_land_size' => $land_size_min,
                'max_land_size' => $land_size_max,

                'localization' => $request->location == NULL ? $property->sub_region : $request->location,
                'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
                'message' => $request->message,
                'prospect_status' => 0
            ]);
        }

        dd('data masuk');

        // Form di landing page
        if ($slug === null) {
            // dd($booking->id);

            $data['data_leads_matches'] = PropertyLeadsModel::where('property_leads.id', $leadsData->id)->select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
                ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')
                ->get();

            // dd($data['data_leads_matches']);

            $leads = $data['data_leads_matches'];
            $data['matchProperties'] = collect();

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

                $emailTo = $request->email;

                Mail::to($emailTo)->send(new NotifikasiEmail([
                    'properties' => $data['matchProperties'],
                ]));
            } else {
                // Kosongkan jika tidak ada leads
                $data['matchProperties'] = collect();

                $emailTo = $request->email;

                Mail::to($emailTo)->send(new NotifikasiEmail([
                    'properties' => $data['matchProperties'],
                ]));
            }

            return view('error.thankyou-page');
        }
        return view('error.thankyou-page');
    }



    private function convertToInteger($value)
    {
        return (int)preg_replace('/[^0-9]/', '', $value);
    }
}
