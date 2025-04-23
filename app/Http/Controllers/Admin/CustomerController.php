<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\VillaModel;
use App\Mail\NotifikasiEmail;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function sendMail($id){

        $customerData = CustomerModel::where('id', $id)->first();
        $villaData = VillaModel::where('sub_region', $customerData->localization)
                ->where('bedroom', '>=', $customerData->require_bedroom)
                ->where('price', '<=', $customerData->budget)
                ->orderBy('price', 'desc')
                ->get();


        // dd($villaData);

        Mail::to($customerData->email)->send(new NotifikasiEmail([
                'name' => $customerData->name, 'villaData' => $villaData
        ]));
        // return view('emails.notifikasi', ['name' => $customerData->name, 'villaData' => $villaData]);
        return back();
    }

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
