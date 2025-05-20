<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyLeadsModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PropertiesLeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role == 'Master'){
            $data['data_customers'] = PropertyLeadsModel::select('property_leads.*', 'properties.id as properties_id', 'properties.property_name')
            ->leftJoin('properties', 'properties.id', '=', 'property_leads.properties_id')->get();
        }else{
            $data['data_customers'] = PropertyLeadsModel::where('customers.agent_code', Auth::user()->reference_code)
            ->select('customers.*', 'properties.id as properties_id', 'properties.property_name')
            ->join('properties', 'properties.id', '=', 'property_leads.properties_id')->get();
        }

        // dd($data['data_customers']);
        //  $data['data_customers'] = PropertyLeadsModel::get();

        return view('admin.leads.index', $data);
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
        PropertyLeadsModel::create([
            'properties_id' => null,
            'agent_code' => null,
            'cust_name' => $request->name,
            'cust_telp' => $request->number,
            'cust_email' => $request->email,
            'cust_budget' => (int)preg_replace('/[^0-9]/', '', $request->budget),
            'require_bedroom' => null,
            'localization' => $request->location,
            'date' => Carbon::createFromFormat('d-m-Y', $request->timing)->format('Y-m-d'),
            'message' => $request->message,
        ]);

        $flashData = [
            'judul' => 'Form Submit Success',
            'pesan' => 'Thank you, we have received your data.',
            'swalFlashIcon' => 'success',
        ];
        
        return redirect()->route('landing-page.index')->with('flashData', $flashData);
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
