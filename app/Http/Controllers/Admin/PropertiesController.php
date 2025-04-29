<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesFeatureModel;
use App\Models\PropertiesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['data_property'] = PropertiesModel::get();
        $data['data_property_count'] = PropertiesModel::count();
        return view('admin.properties.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['features'] = PropertiesFeatureModel::all();
        // dd($data['features']);
        return view('admin.properties.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_name' => 'required|unique:properties',
        ], [
            // 'property_name.required' => 'custom message',
        ]);

        dd($request->all());
        
        $properties = [
            '_token',
            'property_name',
            'property_type',
            'region',
            'subregion',
            'property_address',
            'internal_reference',
            'property_status',
            'year_built',
            'current_owner',
            'owner_contact',
            'property_category',
            'rent_price',
            'price',
            'annual_fees',
            'estimated_rental_income',
        ];

        // Insert Data to table properties 
        $property = PropertiesModel::create([
            'property_uuid' => Str::uuid(),
            'property_name' => $request->property_name,
            'property_type' => $request->property_type,
            'region' => $request->region,
            'sub_region' => $request->subregion,
            'property_address' => $request->property_address,
            'internal_reference' => $request->internal_reference,
            'property_status' => $request->property_status,
            'year_built' => $request->year_built,
            'current_owner' => $request->current_owner,
            'owner_contact' => $request->owner_contact,
            'property_category' => $request->property_category,
            'start_date' => null,
            'end_date' => null,
            'extension_leasehold_possible' => null,
            'leasehold_extension' => null,
            'rent_price' => $request->rent_price,
            'price' => $request->price,
            'annual_fees' => $request->annual_fees,
            'estimated_rental' => null,
        ]);

        $formData = $request->all();
        $propertiesData = collect($formData)->except($properties)->filter()
        ->each(function ($value, $fieldName) use ($property) {
            // dd($fieldName);
            PropertiesFeatureModel::create([
                'properties_id' => $property->id,
                'features_name' => $fieldName,
                'features_value' => is_array($value) ? json_encode($value) : json_encode([$value]),
            ]);
        });

        return redirect()->route('properties.index');
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $uuid)
    {
        // dd($uuid);

        $data['data_properties'] = PropertiesModel::where('property_uuid', $uuid)->first();
        // dd($data['data_properties']);

        return view('admin.properties.details', $data);
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
        PropertiesFeatureModel::where('properties_id', $id)->delete();
        PropertiesModel::destroy($id);
        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Data Property Telah Dihapus',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }
}
