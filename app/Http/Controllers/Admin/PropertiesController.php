<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesFeatureModel;
use App\Models\PropertiesFileModel;
use App\Models\PropertiesModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['property_rent_count'] = PropertiesModel::where('property_status', 'Rented')->count();
        $data['property_sold_count'] = PropertiesModel::where('property_status', 'Sold')->count();
        $data['data_property_count'] = PropertiesModel::count();
        $data['data_property'] = PropertiesModel::join('properties_file', 'properties_file.properties_id', 'properties.id')->get();

        return view('admin.properties.index', $data);
    }

    // function get Foto Asesor
    public function getFeaturedImage($id){
        return PropertiesFileModel::where('properties_id', $id)->first()->featured_image;
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
        // dd($request->all());

        $request->validate([
            'property_name' => 'required|unique:properties',
        ], [
            // 'property_name.required' => 'custom message',
        ]);        

        $properties = [
            '_token',
            'property_name',
            'property_slug',
            'property_type',
            'property_description',
            'region',
            'subregion',
            'property_address',
            'internal_reference',
            'property_status',
            'year_built',
            'current_owner',
            'owner_contact',
            'property_category',
            'start_date',
            'end_date',
            'extension_leasehold_possible',
            'leasehold_extension',
            'rent_price',
            'price',
            'annual_fees',
            'estimated_rental_income',

            // image & file
            'featured_image',
            'property_plan',
            'ownership_certificate',
            'imb_pbg',
        ];

        $price = (float)str_replace(',', '', preg_replace('/[^0-9.]/', '', $request->price));
        $rent_price = (float)str_replace(',', '', preg_replace('/[^0-9.]/', '', $request->rent_price));
        $annual_fees = (float)str_replace(',', '', preg_replace('/[^0-9.]/', '', $request->annual_fees));
        $estimated_rental_income = (float)str_replace(',', '', preg_replace('/[^0-9.]/', '', $request->estimated_rental_income));

        $start_date = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');
        $end_date = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');

        // Insert Data to table properties 
        $property = PropertiesModel::create([
            'property_name' => $request->property_name,
            'property_slug' => Str::slug($request->property_name),
            'property_description' => $request->property_description,
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
            'start_date' => $start_date,
            'end_date' => $end_date,
            'extension_leasehold_possible' => $request->extend_leasehold,
            'leasehold_extension' => $request->duration_extend_leashold,
            'rent_price' => $rent_price,
            'price' => $price,
            'annual_fees' => $annual_fees,
            'estimated_rental' => $estimated_rental_income,
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

        // Image Upload Handler
        if ($request->featured_image === null) {
            $imageName = null;
        } else {
            $imageName = 'featured_img_' . Str::slug($request->property_name) . '.' . $request->featured_image->extension();
            $request->featured_image->move(public_path('admin/uploads/images'), $imageName);
        }

        PropertiesFileModel::create([
            'properties_id' => $property->id,
            'featured_image' => $imageName,
            'gallery' => null,
            'property_plan' => null,
            'ownership_certificate' => null,
            'imb_pbg' => null,
        ]);

        $flashData = [
            'judul' => 'Create Property Success',
            'pesan' => 'New property successfully listed',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('properties.index')->with('flashData', $flashData);
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $slug)
    {
        // dd($slug);
        $property = PropertiesModel::where('property_slug', $slug)->select('id', 'internal_reference')->first();;
        $data['data_properties'] = PropertiesModel::where('property_slug', $slug)->first();


        
        // Features Data
        $features = PropertiesFeatureModel::where('properties_id', $property->id)->get();
        $featureMap = [];

        foreach ($features as $feature) {
            $featureMap[$feature->features_name] = json_decode($feature->features_value, true);
        }
        $data['propertyFeatures'] = $featureMap;
        $data['featuredImage'] = PropertiesFileModel::where('properties_id', $property->id)->select('featured_image')->first()['featured_image'];

        // Agent Data
        $data['agent_data'] = User::where('reference_code', $property->internal_reference)->first();

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

        // Delete Image Handler
        if ($this->getFeaturedImage($id) != null) {
            File::delete(public_path('admin/uploads/images/' . $this->getFeaturedImage($id)));
        }

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
