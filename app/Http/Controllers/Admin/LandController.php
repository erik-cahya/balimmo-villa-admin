<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureListModel;
use App\Models\PropertiesModel;
use App\Models\PropertyFeatureModel;
use App\Models\PropertyFinancialModel;
use App\Models\PropertyGalleryImageModel;
use App\Models\PropertyGalleryModel;
use App\Models\PropertyLegalModel;
use App\Models\PropertyOwnerModel;
use App\Models\PropertyUrlAttachmentModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;




class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['data_property'] = PropertiesModel::select(
            'properties.id',
            'properties.type_properties',
            'property_name',
            'property_slug',
            'internal_reference',
            'bedroom',
            'property_code',
            'region',
            'sub_region',
            'property_address',
            'type_mandate',
            'type_acceptance',
            'bathroom',
            'users.name as agentName',
            'users.status',
        )
            ->with(['featuredImage' => function ($query) {
                $query->select('image_path', 'property_gallery.id');
                $query->where('is_featured', 1);
            }])->leftJoin('users', 'reference_code', '=', 'properties.internal_reference')->get();
            
        return view('admin.land.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['feature_list_outdoor'] = FeatureListModel::where('type', 'outdoor')->where('name', 'LIKE', '%view%')
            ->get();
        $data['feature_list_indoor'] = FeatureListModel::where('type', 'indoor')->get();
        return view('admin.land.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $typeProperties = 'Land';
        $slug = $this->generatePropertiesSlug($request->property_name);

        // $validated = $request->validate([
        //     'images' => 'required|array|min:4',
        //     // 'images.*' => 'image|mimes:jpeg,png,jpg,webp,aviv|max:10024',
        // ]);

        // Validate Owners
        $rules = [];
        foreach ($request->owners as $index => $owner) {
            $prefix = "owners.$index.";

            $isFirst = $index == 0;

            $rules["{$prefix}first_name"] = $isFirst ? 'required|string' : 'nullable|string';
            $rules["{$prefix}last_name"] = $isFirst ? 'required|string' : 'nullable|string';
            $rules["{$prefix}email"] = $isFirst ? 'required|email' : 'nullable|email';
            $rules["{$prefix}phone_number"] = $isFirst ? 'required' : 'nullable';


            if ($isFirst) {
                $messages["{$prefix}first_name.required"] = 'First name of Owner 1 is required.';
                $messages["{$prefix}last_name.required"] = 'Last name of Owner 1 is required.';
                $messages["{$prefix}email.required"] = 'Email of Owner 1 is required.';
                $messages["{$prefix}email.email"] = 'Email of Owner 1 must be a valid email address.';
                $messages["{$prefix}phone_number.required"] = 'Phone number of Owner 1 is required.';
            }
        }
        // /* Validate Owners */


        $request->validate($rules, $messages);

        $request->validate([
            // 'images' => 'required|array|min:4',
            // 'images.*' => 'image|mimes:jpeg,png,jpg,webp,aviv|max:10024',

            'property_name' => 'required',
            'description' => 'required',
            'region' => 'required',
            'subregion' => 'required',
            'property_address' => 'required',

            'feature' => 'required|array|min:1',

            'legal_category' => 'required',

            // // ##### Rental Yield
            // 'average_nightly_rate' => 'required',
            // 'average_occupancy_rate' => 'required',
            // 'month_rented_per_year' => 'required',
            // 'estimated_annual_turnover' => 'required',

            // ##### Gallery
            // 'images.*' => 'required|image|max:2048',
        ], [
            'feature' => 'Please Choose features & Amenities',

        ]);

        // Freehold Validation
        if ($request->legal_category === 'Freehold') {
            $request->validate([
                'freehold_purchase_date' => 'required',
                'freehold_certificate_number' => 'required',
                'freehold_certificate_holder_name' => 'required',
            ]);

            $holder_name = $request->freehold_certificate_holder_name;
            $holder_number = $request->freehold_certificate_number;
            $zoning = $request->freehold_zoning;


            $request->merge([
                'leasehold_start_date' => null,
                'leasehold_end_date' => null,
                'leasehold_contract_number' => null,
                'leasehold_contract_holder_name' => null,
                'leasehold_negotiation_ext_cost' => null,
                'leasehold_purchase_cost' => null,
                'leasehold_deadline_payment' => null,
                'leasehold_green_zone' => 0,
                'leasehold_yellow_zone' => 0,
                'leasehold_pink_zone' => 0,
            ]);
        }
        // Leasehold
        elseif ($request->legal_category === 'Leasehold') {
            $request->validate([
                'leasehold_start_date' => 'required',
                'leasehold_end_date' => 'required',
                'leasehold_contract_number' => 'required',
                'leasehold_contract_holder_name' => 'required',
                'leasehold_negotiation_ext_cost' => 'required',
                'leasehold_purchase_cost' => 'required',
                'leasehold_deadline_payment' => 'required',
            ]);

            $holder_name = $request->leasehold_contract_holder_name;
            $holder_number = $request->leasehold_contract_number;
            $zoning = $request->leasehold_zoning;


            $request->merge([
                'freehold_purchase_date' => null,
                'freehold_certificate_number' => null,
                'freehold_certificate_holder_name' => null,
                'freehold_green_zone' => 0,
                'freehold_yellow_zone' => 0,
                'freehold_pink_zone' => 0,
            ]);
        };

        // ==========================================================================================================================================
        // ########### Create Properties Data ##############
        // ==========================================================================================================================================
        do {
            $property_code = 'BLM-' . random_int(1000000000, 9999999999);
        } while (PropertiesModel::where('property_code', $property_code)->exists());

        $propertyCreate = PropertiesModel::create([
            'type_properties' => $typeProperties,
            'property_code' => $property_code,
            'property_name' => $request->property_name,
            'property_slug' => $slug,
            'internal_reference' => Auth::user()->reference_code,
            'property_description' => $request->description,
            'region' => Str::title($request->region),
            'sub_region' => Str::title($request->subregion),
            'property_address' => $request->property_address,
            'total_land_area' => $this->floatNumbering($request->land_size),
            'type_mandate' => $request->type_mandate,

            'type_acceptance' => explode('-', Auth::user()->reference_code)[0] == 'BPM' ? 'accept' : 'pending',
        ]);

        // ==========================================================================================================================================
        // ########### Create Property Owner Data ##############
        // ==========================================================================================================================================
        foreach ($request->owners as $index => $owner) {
            // Cek apakah semua field bernilai null atau kosong
            if (
                empty($owner['first_name']) &&
                empty($owner['last_name']) &&
                empty($owner['phone_number']) &&
                empty($owner['email'])
            ) {
                continue;
            }
            PropertyOwnerModel::create([
                'properties_id' => $propertyCreate->id,
                'first_name' => $owner['first_name'],
                'last_name' => $owner['last_name'],
                'phone' => $owner['phone_number'],
                'email' => $owner['email'],
                'owner_order' => $index + 1,
            ]);
        }

        // ==========================================================================================================================================
        // ########### Create Properties Legal ##############
        // ==========================================================================================================================================
        PropertyLegalModel::create([
            'properties_id' => $propertyCreate->id,
            'company_name' => $request->company_name,
            'rep_first_name' => $request->legal_rep_last_name,
            'rep_last_name' => $request->legal_rep_first_name,
            'phone' => $request->legal_rep_phone_number,
            'email' => $request->legal_rep_email,

            'legal_status' => $request->legal_category,
            'holder_name' => $holder_name,
            'holder_number' => $holder_number,
            'start_date' => $request->leasehold_start_date == null ? null : $this->dateConversion($request->leasehold_start_date),
            'end_date' =>  $request->leasehold_end_date == null ? null : $this->dateConversion($request->leasehold_end_date),
            'purchase_date' => $request->freehold_purchase_date == null ? null : $this->dateConversion($request->freehold_purchase_date),
            'extension_cost' => (int)preg_replace('/[^0-9]/', '', $request->leasehold_negotiation_ext_cost),
            'purchase_cost' =>  (int)preg_replace('/[^0-9]/', '', $request->leasehold_purchase_cost),
            'deadline_payment' => $request->leasehold_deadline_payment == null ? null : $this->dateConversion($request->leasehold_deadline_payment),
            'zoning' => $zoning,
        ]);

        // ==========================================================================================================================================
        // ############## Create Properties Financial ##############
        // ==========================================================================================================================================
        $idrPrice = (int)preg_replace('/[^0-9]/', '', $request->idr_price);
        $usdPrice = round((float)$idrPrice / $this->getUSDtoIDRRate(), 2);

        // Presentase
        if ($idrPrice < 15000000000) {
            $commision = 5;
        } else if ($idrPrice >= 15000000000  && $idrPrice <= 34000000000) {
            $commision = 4;
        } else if ($idrPrice > 34000000000  && $idrPrice <= 70000000000) {
            $commision = 3;
        } else {
            $commision = 2.5;
        }

        $commisionAmmountIDR = $idrPrice * $commision / 100;
        $commisionAmmountUSD = round($usdPrice * $commision / 100, 2);
        $netSellerIDR = $idrPrice - $commisionAmmountIDR;
        $netSellerUSD = round($usdPrice - $commisionAmmountUSD, 2);


        PropertyFinancialModel::create([
            'properties_id' => $propertyCreate->id,
            'avg_nightly_rate' => (int)preg_replace('/[^0-9]/', '', $request->average_nightly_rate),
            'avg_occupancy_rate' => $request->average_occupancy_rate,
            'months_rented' => $request->month_rented_per_year,
            'annual_turnover' => (int)preg_replace('/[^0-9]/', '', $request->estimated_annual_turnover),

            // Sale Price & Conditions
            'selling_price_idr' => $idrPrice,
            'selling_price_usd' => $usdPrice,
            'commision_ammount_idr' => $commisionAmmountIDR,
            'commision_ammount_usd' => $commisionAmmountUSD,
            'net_seller_idr' => $netSellerIDR,
            'net_seller_usd' => $netSellerUSD,
        ]);

        // ==========================================================================================================================================
        // ########### Create Property Feature Data
        // ==========================================================================================================================================
        foreach ($request->feature as $index => $feature) {
            $idFeature = FeatureListModel::select('id')->where('slug', $index)->first();
            PropertyFeatureModel::create([
                'properties_id' => $propertyCreate->id,
                'feature_id' => $idFeature->id
            ]);
        }

        // ==========================================================================================================================================
        // ########### Create Property URL & Attachment ##############
        // ==========================================================================================================================================

        if ($request->file_rental_support !== null) {
            $fileRentalSupport = $request->file_rental_support->getClientOriginalName();
            $request->file_rental_support->move(public_path('admin/attachment/' . $slug), $fileRentalSupport);
        } else {
            $fileRentalSupport = null;
        }

        if ($request->file_type_of_mandate !== null) {

            $fileTypeMandate = $request->file_type_of_mandate->getClientOriginalName();
            $request->file_type_of_mandate->move(public_path('admin/attachment/' . $slug), $fileTypeMandate);
        } else {
            $fileTypeMandate = null;
        }

        // Create Property URL & Attachment
        $dataURL = $request->only(['url_virtual_tour', 'url_lifestyle', 'url_experience']);
        $dataURL['file_rental_support'] = $fileRentalSupport;
        $dataURL['file_type_of_mandate'] = $fileTypeMandate;

        foreach ($dataURL as $key => $value) {
            PropertyUrlAttachmentModel::create([
                'properties_id' => $propertyCreate->id,
                'name' => $key,
                'path_attachment' => $value
            ]);
        }

        // ==========================================================================================================================================
        // ############## Gallery Handler ##############
        // ==========================================================================================================================================
        $gallery = PropertyGalleryModel::create([
            'properties_id' => $propertyCreate->id,
            'description' => 'deskripsi',
        ]);

        if ($request->has('old_images')) {
            foreach ($request->old_images as $i => $filename) {
                $from = public_path("tmp_uploads/" . Auth::user()->reference_code . "/$filename");
                $targetDir = public_path("admin/gallery/{$slug}");
                $to = $targetDir . '/' . $filename;

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }

                if (file_exists($from)) {
                    rename($from, $to);

                    PropertyGalleryImageModel::create([
                        'gallery_id' => $gallery->id,
                        'image_path' => "admin/gallery/{$slug}/{$filename}",
                        'order' => $i,
                        'is_featured' => $i === 0,
                    ]);
                }
            }

            session()->forget('old_images'); // hapus setelah sukses

            if (file_exists(public_path('tmp_uploads/' . Auth::user()->reference_code))) {
                File::deleteDirectory(public_path('tmp_uploads/' . Auth::user()->reference_code));
            };
        } else {
            if (!file_exists(public_path('admin/gallery/' . $slug))) {
                mkdir(public_path('admin/gallery/' . $slug), 0755, true);
            }

            $order = explode(',', $request->order);

            foreach ($order as $i => $index) {
                if (isset($request->images[$index])) {
                    $image = $request->images[$index];
                    $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('admin/gallery/' . $slug), $filename);

                    PropertyGalleryImageModel::create([
                        'gallery_id' => $gallery->id,
                        'image_path' => 'admin/gallery/' . $slug . '/' . $filename,
                        'order' => $i,
                        'is_featured' => $i === 0,
                    ]);
                }
            }
        }
        // /* Gallery Handler

        Cache::forget('properties_list_cache');


        $flashData = [
            'judul' => 'Create Land Success',
            'pesan' => 'New land successfully listed',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('properties.index')->with('flashData', $flashData);
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




    private function getUSDtoIDRRate()
    {
        return Cache::remember('usd_to_idr_rate', now()->addHours(1), function () {
            try {
                $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
                return $response['rates']['IDR'] ?? 15000;
            } catch (\Exception $e) {
                return 15000;
            }
        });
    }

    private function convertToInteger($value)
    {
        return (int)preg_replace('/[^0-9]/', '', $value);
    }

    private function dateConversion($date)
    {
        return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
    }

    private function generatePropertiesSlug($name)
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 2;

        // Cek property slug if exist in database
        while (PropertiesModel::where('property_slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function floatNumbering($number)
    {
        $number = trim($number);

        // Hapus semua spasi
        $number = str_replace(' ', '', $number);

        // EU format: ada koma (,) sebagai desimal
        if (preg_match('/\d+\.\d+,\d+/', $number) || preg_match('/\d+,\d+/', $number)) {
            // Hapus titik sebagai ribuan, ganti koma jadi titik
            $number = str_replace('.', '', $number);
            $number = str_replace(',', '.', $number);
        }

        // US format: koma sebagai ribuan, titik sebagai desimal
        elseif (preg_match('/\d+,\d+\.\d+/', $number) || preg_match('/\d+,\d{3}/', $number)) {
            $number = str_replace(',', '', $number);
        }

        return floatval($number);
    }
}
