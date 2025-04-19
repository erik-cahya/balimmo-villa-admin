<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\VillaModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // public function index(){
    //     $data['customers'] = CustomerModel::get();
    //     $data['villa'] = VillaModel::get();

    //     dd($data['villa']->all());
    //     return view('admin.customers.index', $data);
    // }

    public function index()
    {
        $customers = CustomerModel::all();
        $villas = VillaModel::all();
        
        $matchedVillas = [];
        
        foreach ($customers as $customer) {
            $matchedVillas[$customer->id] = VillaModel::where('sub_region', $customer->localization)
                ->where('bedroom', '>=', $customer->require_bedroom)
                ->where('price', '<=', $customer->budget)
                ->orderBy('price', 'desc') // Urutkan dari harga tertinggi ke terendah
                ->get();
        }
        return view('admin.customers.index', [
            'customers' => $customers,
            'matchedVillas' => $matchedVillas,
            'villas' => $villas
        ]);
    }

    public function form(){
        return view('admin.customers.client_form');
    }

    public function store(Request $request){

        CustomerModel::create([
            'name' => $request->name,
            'telp' => $request->telp,
            'email' => $request->email,
            'budget' => $request->budget,
            'require_bedroom' => $request->require_bedroom,
            'localization' => $request->localization,
            'time' => $request->time,
        ]);

        return redirect()->route('customer.form');
    }
}
