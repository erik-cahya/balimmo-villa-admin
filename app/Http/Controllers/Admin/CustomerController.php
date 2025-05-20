<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\VillaModel;
use App\Mail\NotifikasiEmail;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{

    public function index()
    {
        // dd(Auth::user());

        if(Auth::user()->role == 'master'){
            $data['data_customers'] = CustomerModel::select('customers.*', 'properties.id as properties_id', 'properties.property_name')
            ->join('properties', 'properties.id', '=', 'customers.properties_id')->get();
        }else{
            $data['data_customers'] = CustomerModel::where('customers.agent_code', Auth::user()->reference_code)
            ->select('customers.*', 'properties.id as properties_id', 'properties.property_name')
            ->join('properties', 'properties.id', '=', 'customers.properties_id')->get();
        }


        return view('admin.customers.index', $data);   
    }

    public function booking($slug, Request $request){
        $property = PropertiesModel::where('property_slug', $slug)->first();
        // dd($request->all());
        PropertyLeadsModel::create([
            'properties_id' => $property->id,
            'agent_code' => $request->agent_code,
            'cust_name' => $request->name,
            'cust_telp' => $request->phone_number,
            'cust_email' => $request->email,
            'cust_budget' => (int)preg_replace('/[^0-9]/', '', $request->budget),
            'require_bedroom' => $request->bedroom,
            'localization' => $request->location,
            'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
            'message' => null
        ]);

        return back();
        
    }
}
