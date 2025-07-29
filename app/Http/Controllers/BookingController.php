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

        // dd($slug);
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

        // dd($request->all());
        // dd($slug);

        $property = PropertiesModel::where('property_slug', $slug)->first();
        $newCustomerData = CustomerDataModel::create([
            'agent_code' => $slug == NULL ? NULL : $property->internal_reference,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cust_phone' => $request->phone_number,
            'cust_email' => $request->email
        ]);

        // IDR / USD Budget
        if ($request->budget_currency == 'idr') {

            $villa_MinimumBudgetIDR = $this->convertToInteger($request->budget_idr_min_villa);
            $villa_MaximumBudgetIDR = $this->convertToInteger($request->budget_idr_max_villa);
            $land_MinimumBudgetIDR = $this->convertToInteger($request->budget_idr_min_land);
            $land_MaximumBudgetIDR = $this->convertToInteger($request->budget_idr_max_land);

            $villa_MinimumBudgetUSD = NULL;
            $villa_MaximumBudgetUSD = NULL;
            $land_MinimumBudgetUSD = NULL;
            $land_MaximumBudgetUSD = NULL;
        } else {

            $villa_MinimumBudgetUSD = floatval(preg_replace('/[^\d.]/', '', $request->budget_usd_min_villa));
            $villa_MaximumBudgetUSD = floatval(preg_replace('/[^\d.]/', '', $request->budget_usd_max_villa));
            $land_MinimumBudgetUSD = floatval(preg_replace('/[^\d.]/', '', $request->budget_usd_min_land));
            $land_MaximumBudgetUSD = floatval(preg_replace('/[^\d.]/', '', $request->budget_usd_max_land));

            $villa_MinimumBudgetIDR = NULL;
            $villa_MaximumBudgetIDR = NULL;
            $land_MinimumBudgetIDR = NULL;
            $land_MaximumBudgetIDR = NULL;
        }

        $bedroom_min = $request->bedroom_min;
        $bedroom_max = $request->bedroom_max;
        $land_size_min = $request->land_size_min;
        $land_size_max = $request->land_size_max;

        if ($slug == null) {

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

                    'min_budget_idr' => $villa_MinimumBudgetIDR,
                    'max_budget_idr' => $villa_MaximumBudgetIDR,
                    'min_budget_usd' => $villa_MinimumBudgetUSD,
                    'max_budget_usd' => $villa_MaximumBudgetUSD,

                    'min_bedroom' => $bedroom_min,
                    'max_bedroom' => $bedroom_max,

                    'localization' => $request->location == NULL ? $property->sub_region : $request->location,
                    'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
                    'message' => $request->message,
                    'visibility' => 1,
                ]);
            }
            // Jika type asset land dipilih
            if ($request->type_asset_land !== null) {
                $leadsData = PropertyLeadsModel::create([
                    'properties_id' => $slug == NULL ? NULL : $property->id,
                    'customer_id' => $newCustomerData->id,
                    'type_asset' => $request->type_asset_land,

                    'min_budget_idr' => $land_MinimumBudgetIDR,
                    'max_budget_idr' => $land_MaximumBudgetIDR,
                    'min_budget_usd' => $land_MinimumBudgetUSD,
                    'max_budget_usd' => $land_MaximumBudgetUSD,

                    'min_land_size' => $land_size_min,
                    'max_land_size' => $land_size_max,

                    'localization' => $request->location == NULL ? $property->sub_region : $request->location,
                    'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
                    'message' => $request->message,
                    'visibility' => 1,

                ]);
            }
        } else {
            $leadsData = PropertyLeadsModel::create([
                'properties_id' => $slug == NULL ? NULL : $property->id,
                'customer_id' => $newCustomerData->id,
                'type_asset' => $property->type_properties,

                'min_budget_idr' => $request->budget_idr_min !== NULL ? $this->convertToInteger($request->budget_idr_min) : NULL,
                'max_budget_idr' => $request->budget_idr_max !== NULL ? $this->convertToInteger($request->budget_idr_max) : NULL,
                'min_budget_usd' => $request->budget_usd_min !== NULL ? floatval(preg_replace('/[^\d.]/', '', $request->budget_usd_min)) : NULL,
                'max_budget_usd' => $request->budget_usd_max !== NULL ? floatval(preg_replace('/[^\d.]/', '', $request->budget_usd_max)) : NULL,

                'min_bedroom' => $bedroom_min,
                'max_bedroom' => $bedroom_max,
                'min_land_size' => $land_size_min,
                'max_land_size' => $land_size_max,

                'localization' => $request->location == NULL ? $property->sub_region : $request->location,
                'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
                'message' => $request->message,
                'visibility' => 1,
            ]);
        }

        // dd('data masuk');
        return view('error.thankyou-page');
    }



    private function convertToInteger($value)
    {
        return (int)preg_replace('/[^0-9]/', '', $value);
    }
}
