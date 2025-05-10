<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesFeatureModel;
use App\Models\PropertiesFileModel;
use App\Models\PropertiesModel;
use App\Models\PropertyLegalModel;
use App\Models\PropertyOwnerModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['data_property'] = PropertiesModel::get();

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
        // $data['features'] = PropertiesFeatureModel::all();
        // dd($data['features']);
        return view('admin.properties.create');
    }

    private function getUSDtoIDRRate()
    {
        try {
            $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
            return $response['rates']['IDR'] ?? 15000; // fallback
        } catch (\Exception $e) {
            return 15000; // fallback jika API gagal
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($this->getUSDtoIDRRate());
        // dd($request->all());

            if($request->legal_category === 'Freehold'){
            $request->validate([
                'freehold_purchase_date' => 'required',
                'freehold_certificate_number' => 'required',
                'freehold_certificate_holder_name' => 'required',
                'freehold_green_zone' => 'required',
                'freehold_yellow_zone' => 'required',
                'freehold_pink_zone' => 'required',
            ]);

            $request->leasehold_start_date = null;
            $request->leasehold_end_date = null;
            $request->leasehold_contract_number = null;
            $request->leasehold_contract_holder_name = null;
            $request->leasehold_negotiation_ext_cost = null;
            $request->leasehold_purchase_cost = null;
            $request->leasehold_deadline_payment = null;
            $request->leasehold_green_zone = null;
            $request->leasehold_yellow_zone = null;
            $request->leasehold_pink_zone = null;
        }
        elseif($request->legal_category === 'Leasehold'){
            $request->validate([
                'leasehold_start_date' => 'required',
                'leasehold_end_date' => 'required',
                'leasehold_contract_number' => 'required',
                'leasehold_contract_holder_name' => 'required',
                'leasehold_negotiation_ext_cost' => 'required',
                'leasehold_purchase_cost' => 'required',
                'leasehold_deadline_payment' => 'required',
                'leasehold_green_zone' => 'required',
                'leasehold_yellow_zone' => 'required',
                'leasehold_pink_zone' => 'required',
            ]);

            $request->freehold_purchase_date = null;
            $request->freehold_certificate_number = null;
            $request->freehold_certificate_holder_name = null;
            $request->freehold_green_zone = null;
            $request->freehold_yellow_zone = null;
            $request->freehold_pink_zone = null;
        };


        $request->validate([
            'property_name' => 'required|unique:properties',
            'description' => 'required',
            'region' => 'required',
            'subregion' => 'required',
            'property_address' => 'required',
            'land_size' => 'required',
            'built_area' => 'required',
            'pool_area' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'year_construction' => 'required',
            'year_renovated' => 'required',
            'owners[0][first_name]' => 'required',
            'owners[0][last_name]' => 'required',
            'owners[0][email]' => 'required',
            'owners[0][phone_number]' => 'required',
        ],[
            'owners[0][first_name].required' => 'The Owner Name field is required.',
            'owners[0][last_name].required' => 'The Owner Last Name field is required.',
            'owners[0][email].required' => 'The Email field is required.',
            'owners[0][phone_number].required' => 'The Phone Number field is required.', 
        ]); 

        // ########### Create Properties Data
        $propertyCreate = PropertiesModel::create([
            'property_name' => $request->property_name,
            'property_slug' => Str::slug($request->property_name),
            'internal_reference' => Auth::user()->reference_code,
            'property_description' => $request->description,
            'region' => Str::title($request->region),
            'sub_region' => Str::title($request->subregion),
            'property_address' => $request->property_address,
            'total_land_area' => preg_replace('/[^0-9,]/', '', floatval($request->land_size)),
            'villa_area' => preg_replace('/[^0-9,]/', '', floatval($request->built_area)),
            'pool_area' => preg_replace('/[^0-9,]/', '', floatval($request->pool_area)),
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'year_construction' => $request->year_construction,
            'year_renovated' => $request->year_renovated,
        ]);

        // ########### Create Property Owner Data
        foreach($request->owners as $index => $owner){
            PropertyOwnerModel::create([
                'properties_id' => $propertyCreate->id,
                'first_name' => $owner['first_name'],
                'last_name' => $owner['last_name'],
                'phone' => $owner['phone_number'],
                'email' => $owner['email'],
                'owner_order' => $index + 1,
            ]);
        };

        // ########### Create Properties Legal
        PropertyLegalModel::create([
            'properties_id' => $propertyCreate->id,
            'company_name' => $request->company_name,
            'rep_first_name' => $request->legal_rep_last_name,
            'rep_last_name' => $request->legal_rep_first_name,
            'phone' => $request->legal_rep_phone_number,
            'email' => $request->legal_rep_email,

            // 'legal_status' => ,
            // 'holder_name' => ,
            // 'holder_number' => ,
            // 'start_date' => ,
            // 'end_date' => ,
            // 'purchase_date' => ,
            // 'extension_cost' => ,
            // 'purchase_cost' => ,
            // 'deadline_payment' => ,
            // 'zoning' => ,
        ]);




        // dd('done');

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
        // if ($this->getFeaturedImage($id) != null) {
        //     File::delete(public_path('admin/uploads/images/' . $this->getFeaturedImage($id)));
        // }

        PropertyOwnerModel::where('properties_id', $id)->delete();
        PropertiesModel::destroy($id);

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Data Property Telah Dihapus',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }
}
