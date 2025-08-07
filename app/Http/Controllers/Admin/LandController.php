<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Land;
use App\Models\Land\LandFeatureListModel;
use App\Models\Land\LandFeatureModel;
use App\Models\Land\LandFinancialModel;
use App\Models\Land\LandGalleryImageModel;
use App\Models\Land\LandGalleryModel;
use App\Models\Land\LandLegalModel;
use App\Models\Land\LandModel;
use App\Models\Land\LandOwnerModel;
use App\Models\Land\LandUrlAttachmentModel;
use App\Models\PropertyFeatureListModel;
use App\Models\PropertyFinancialModel;
use App\Models\PropertyGalleryImageModel;
use App\Models\PropertyGalleryModel;
use App\Models\PropertyLegalModel;
use App\Models\User;
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

        if (Auth::user()->role == 'master') {
            $data['data_land'] = LandModel::select(
                'land.id',
                'land.type_properties',
                'land_name',
                'land_slug',
                'internal_reference',
                'land_code',
                'area',
                'region',
                'total_land_area',
                'sub_region',
                'land_address',
                'type_mandate',
                'type_acceptance',
                'users.name as agentName',
                'users.status',
                'land_financial.selling_price_idr',
                'land_financial.selling_price_usd',

            )
                ->join('land_financial', 'land_financial.land_id', '=', 'land.id')
                ->with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'land_gallery.id');
                    $query->where('is_featured', 1);
                }])->leftJoin('users', 'reference_code', '=', 'land.internal_reference')->get();
        } else {
            $data['data_land'] = LandModel::where('land.internal_reference', Auth::user()->reference_code)
                ->select(
                    'land.id',
                    'land.type_properties',
                    'land_name',
                    'land_slug',
                    'internal_reference',
                    'land_code',
                    'total_land_area',
                    'region',
                    'sub_region',
                    'land_address',
                    'type_mandate',
                    'type_acceptance',
                    'land_financial.selling_price_idr',
                    'land_financial.selling_price_usd',

                )
                ->join('land_financial', 'land_financial.land_id', '=', 'land.id')
                ->with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'land_gallery.id');
                    $query->where('is_featured', 1);
                }])->get();
        }

        // dd($data['data_land']);

        return view('admin.land.index', $data);
    }

    public function detail($slug)
    {
        // Ambil properti utama berdasarkan slug
        $property = LandModel::with([
            'featuredImage', // gunakan relasi hasOneThrough
        ])->where('land_slug', $slug)->firstOrFail();

        // Ambil data legal & financial via model relasi (jika kamu punya relasi, contoh di bawah)
        $financial = LandFinancialModel::where('land_id', $property->id)->first();
        $legal     = LandLegalModel::where('land_id', $property->id)->first();

        // Gabungkan semua data ke model utama
        $property->avg_nightly_rate     = optional($financial)->avg_nightly_rate;
        $property->avg_occupancy_rate   = optional($financial)->avg_occupancy_rate;
        $property->desired_price_idr    = optional($financial)->desired_price_idr;
        $property->desired_price_usd    = optional($financial)->desired_price_usd;
        $property->selling_price_idr    = optional($financial)->selling_price_idr;
        $property->selling_price_usd    = optional($financial)->selling_price_usd;
        $property->net_seller_idr       = optional($financial)->net_seller_idr;
        $property->net_seller_usd       = optional($financial)->net_seller_usd;

        $property->company_name         = optional($legal)->company_name;
        $property->rep_first_name       = optional($legal)->rep_first_name;
        $property->rep_last_name        = optional($legal)->rep_last_name;
        $property->phone                = optional($legal)->phone;
        $property->email                = optional($legal)->email;
        $property->legal_status         = optional($legal)->legal_status;
        $property->holder_name          = optional($legal)->holder_name;
        $property->holder_number        = optional($legal)->holder_number;
        $property->start_date           = optional($legal)->start_date;
        $property->end_date             = optional($legal)->end_date;
        $property->purchase_date        = optional($legal)->purchase_date;
        $property->extension_cost       = optional($legal)->extension_cost;
        $property->purchase_cost        = optional($legal)->purchase_cost;
        $property->deadline_payment     = optional($legal)->deadline_payment;
        $property->zoning               = optional($legal)->zoning;

        $data['data_properties'] = $property;

        // Fitur tanah
        $data['feature_list'] = LandFeatureModel::where('land_id', $property->id)
            ->join('land_feature_list', 'land_feature_list.id', '=', 'land_feature.feature_land_id')
            ->select('land_feature_list.name as feature_name')
            ->get();

        // Ambil gallery_id dari featuredImage (jika ada)
        $galleryId = optional($property->featuredImage)->land_gallery_id;

        // Ambil semua image gallery berdasarkan gallery_id
        $data['image_gallery'] = $galleryId
            ? LandGalleryImageModel::where('land_gallery_id', $galleryId)->get()
            : collect();

        // Data agen
        $data['agent_data'] = User::where('reference_code', $property->internal_reference)->first();

        // Pemilik properti
        $data['property_owner'] = LandOwnerModel::where('land_id', $property->id)->get();

        // URL attachment (YouTube embed, dll.)
        $url_attachment = LandUrlAttachmentModel::where('land_id', $property->id)->get();

        foreach ($url_attachment as $url) {
            if (in_array($url->name, ['url_virtual_tour', 'url_lifestyle', 'url_experience'])) {
                preg_match(
                    '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                    $url->path_attachment,
                    $match
                );
                $url->path_attachment = $match[1] ?? null;
            }
        }

        $data['attachment'] = collect($url_attachment);

        return view('admin.land.details', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['feature_list'] = LandFeatureListModel::get();

        $data['feature_list_indoor'] = PropertyFeatureListModel::where('type', 'indoor')->get();
        return view('admin.land.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $typeProperties = 'land';
        $slug = $this->generatePropertiesSlug($request->property_name);

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

        $request->validate($rules, $messages);

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
        // ########### Create Land Data ##############
        // ==========================================================================================================================================
        do {
            $land_code = 'BLM-' . random_int(1000000000, 9999999999);
        } while (LandModel::where('land_code', $land_code)->exists());

        $landCreate = LandModel::create([
            'type_properties' => $typeProperties,
            'land_code' => $land_code,
            'land_name' => $request->property_name,
            'land_slug' => $slug,
            'internal_reference' => Auth::user()->reference_code,
            'land_description' => $request->description,
            'region' => Str::title($request->region),
            'sub_region' => Str::title($request->subregion),
            'area' => Str::title($request->area),
            'land_address' => $request->property_address,
            'total_land_area' => $this->floatNumbering($request->land_size),

            'land_width' => $this->floatNumbering($request->land_width),
            'land_length' => $this->floatNumbering($request->land_length),

            'is_land_split' => $request->split_land,
            'minimum_split' => $request->split_land_value,

            'type_mandate' => $request->type_mandate,

            'type_acceptance' => explode('-', Auth::user()->reference_code)[0] == 'BPM' ? 'accept' : 'pending',
        ]);

        // ==========================================================================================================================================
        // ########### Create Land Owner Data ##############
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
            LandOwnerModel::create([
                'land_id' => $landCreate->id,
                'first_name' => $owner['first_name'],
                'last_name' => $owner['last_name'],
                'phone' => $owner['phone_number'],
                'email' => $owner['email'],
                'owner_order' => $index + 1,
            ]);
        }

        // ==========================================================================================================================================
        // ########### Create Land Legal ##############
        // ==========================================================================================================================================
        LandLegalModel::create([
            'land_id' => $landCreate->id,
            'company_name' => $request->company_name,
            'rep_first_name' => $request->legal_rep_first_name,
            'rep_last_name' => $request->legal_rep_last_name,
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

 

        $idrPrice = $this->convertToInteger($request->website_price); // Ambil website_price yang sudah dikalkulasi
        $usdPrice = round((float)$idrPrice / $this->getUSDtoIDRRate(), 2);

        LandFinancialModel::create([

            'land_id' => $landCreate->id,
            
            // Rental Yield
            'average_price_status' => $request->average_price_status,
            'avg_nightly_rate' => $this->convertToInteger($request->average_nightly_rate),
            'avg_occupancy_rate' => $request->average_occupancy_rate,

            // Agent
            'find_property_of' => $request->find_property,
            'agent_name' => $request->agent_name,
            'agent_email' => $request->agent_email,
            'agent_phone' => $request->agent_whatsapp,

            // Price Structure
            'base_price_option' => $request->base_price, // Selling price / Price to owner
            'base_price' => $this->convertToInteger($request->desire_price_from_the_owner), // This is the main base price
            'desired_price_idr' => $this->convertToInteger($request->price_to_owner), // Harga yg diterima Owner
            'desired_price_usd' => $this->idrToUsdConvert($request->price_to_owner),

            // Commission Details
            'agent_commision' => $request->commission_of_the_agent,
            'give_balimmo_commision' => $request->full_commission_balimmo,
            'balimmo_commision' => $request->balimmo_commission,

            // Sale Price & Net Profit
            'selling_price_idr' => $idrPrice,
            'selling_price_usd' => $usdPrice,
            'net_seller_idr' => $this->convertToInteger($request->net_profit),
            'net_seller_usd' => $this->idrToUsdConvert($request->net_profit),
        ]);



        // ==========================================================================================================================================
        // ########### Create Property Feature Data
        // ==========================================================================================================================================
        foreach ($request->feature as $index => $feature) {
            $idFeature = LandFeatureListModel::select('id')->where('slug', $index)->first();
            LandFeatureModel::create([
                'land_id' => $landCreate->id,
                'feature_land_id' => $idFeature->id
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
            LandUrlAttachmentModel::create([
                'land_id' => $landCreate->id,
                'name' => $key,
                'path_attachment' => $value
            ]);
        }

        // ==========================================================================================================================================
        // ############## Gallery Handler ##############
        // ==========================================================================================================================================
        $gallery = LandGalleryModel::create([
            'land_id' => $landCreate->id,
            'description' => 'land gallery',
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

                    LandGalleryImageModel::create([
                        'land_gallery_id' => $gallery->id,
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

                    LandGalleryImageModel::create([
                        'land_gallery_id' => $gallery->id,
                        'image_path' => 'admin/gallery/' . $slug . '/' . $filename,
                        'order' => $i,
                        'is_featured' => $i === 0,
                    ]);
                }
            }
        }
        // /* Gallery Handler

        Cache::forget('land_list_cache');

        // dd($gallery->id);

        $flashData = [
            'judul' => 'Create Land Success',
            'pesan' => 'New land successfully listed',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('land.index')->with('flashData', $flashData);
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
    public function edit($slug)
    {
        $data['data_properties'] = LandModel::where('land_slug', $slug)
            ->join('land_financial', 'land_financial.land_id', '=', 'land.id')
            ->join('land_legal', 'land_legal.land_id', '=', 'land.id')
            ->with(['featuredImage' => function ($query) {
                $query->select('image_path', 'land_gallery.id');
                $query->where('is_featured', 1);
            }])
            ->select(
                'land.*',
                // 'land_financial.*',

                // Rental Yield
                'land_financial.average_price_status',
                'land_financial.avg_nightly_rate',
                'land_financial.avg_occupancy_rate',


                // Agent
                'land_financial.find_property_of',
                'land_financial.agent_name',
                'land_financial.agent_email',
                'land_financial.agent_phone',

                // Price Structure
                'land_financial.base_price_option',
                'land_financial.base_price',
                'land_financial.desired_price_idr',

                // Commission Details
                'land_financial.agent_commision',
                'land_financial.give_balimmo_commision',
                'land_financial.balimmo_commision',
                
                // Sale Price & Net Profit
                'land_financial.selling_price_idr',
                'land_financial.net_seller_idr',

                'land_legal.company_name',
                'land_legal.rep_first_name',
                'land_legal.rep_last_name',
                'land_legal.phone',
                'land_legal.email',
                'land_legal.legal_status',
                'land_legal.holder_name',
                'land_legal.holder_number',
                'land_legal.start_date',
                'land_legal.end_date',
                'land_legal.purchase_date',
                'land_legal.extension_cost',
                'land_legal.purchase_cost',
                'land_legal.deadline_payment',
                'land_legal.zoning',
            )
            ->first();

        // dd($data['data_properties']['featuredImage']->id);



        // Property Owner
        // dd($data['data_properties']);
        $data['property_owner'] = LandOwnerModel::where('land_id', $data['data_properties']->id)->get();

        $data['feature_list'] = LandFeatureListModel::where('type', 'land-feature')->get();
        $data['properties_feature'] = LandFeatureModel::where('land_id', $data['data_properties']->id)->get();
        $data['selected_feature_ids'] = $data['properties_feature']->pluck('feature_land_id')->toArray();


        // URL Attachment
        $url_attachment = LandUrlAttachmentModel::where('land_id', $data['data_properties']->id)->select('name', 'path_attachment')->get();
        $attachment = [];
        foreach ($url_attachment as $key) {
            $attachment[$key->name] = $key->path_attachment;
        };


        $data['attachment'] = $attachment;

        $galleryId = optional($data['data_properties']['featuredImage'])->id;
        // dd($galleryId);
        $data['image_gallery'] = $galleryId
            ? LandGalleryImageModel::where('land_gallery_id', $galleryId)->get()
            : collect(); // Jika galleryId null, hasilkan koleksi kosong

        // $data['image_gallery'] = PropertyGalleryImageModel::where('gallery_id', $data['data_properties']['featuredImage']->id)->get();


        return view('admin.land.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $land = LandModel::findOrFail($id);

        // ========== SLUG ========== 
        $slug = $land->land_slug;
        if ($land->land_name != $request->property_name) {
            $slug = $this->generatePropertiesSlug($request->property_name);
        }

        // ========== VALIDASI LEGAL ========== 
        if ($request->legal_category === 'Freehold') {
            $request->validate([
                'freehold_purchase_date' => 'required',
                'freehold_certificate_number' => 'required',
                'freehold_certificate_holder_name' => 'required',
            ]);
        } elseif ($request->legal_category === 'Leasehold') {
            $request->validate([
                'leasehold_start_date' => 'required',
                'leasehold_end_date' => 'required',
                'leasehold_contract_number' => 'required',
                'leasehold_contract_holder_name' => 'required',
                'leasehold_negotiation_ext_cost' => 'required',
                'leasehold_purchase_cost' => 'required',
                'leasehold_deadline_payment' => 'required',
            ]);
        }

        // ========== UPDATE LAND ========== 
        $land->update([
            'land_name' => $request->property_name,
            'land_slug' => $slug,
            'land_description' => $request->description,
            'region' => $request->region,
            'sub_region' => $request->subregion,
            'area' => $request->area,
            'land_address' => $request->property_address,
            'total_land_area' => $this->floatNumbering($request->land_size),
            'land_width' => $this->floatNumbering($request->land_width),
            'land_length' => $this->floatNumbering($request->land_length),
            'is_land_split' => $request->split_land,
            'minimum_split' => $request->split_land_value,
            'type_mandate' => $request->type_mandate,
        ]);

        // ========== UPDATE OWNER ========== 
        LandOwnerModel::where('land_id', $id)->delete();
        if ($request->has('owners')) {
            foreach ($request->owners as $index => $owner) {
                if (
                    empty($owner['first_name']) &&
                    empty($owner['last_name']) &&
                    empty($owner['phone_number']) &&
                    empty($owner['email'])
                ) continue;

                LandOwnerModel::create([
                    'land_id' => $id,
                    'first_name' => $owner['first_name'],
                    'last_name' => $owner['last_name'],
                    'phone' => $owner['phone_number'],
                    'email' => $owner['email'],
                    'owner_order' => $index + 1,
                ]);
            }
        }

        // ========== UPDATE LEGAL ========== 
        LandLegalModel::where('land_id', $id)->update([
            'company_name' => $request->company_name,
            'rep_first_name' => $request->legal_rep_first_name,
            'rep_last_name' => $request->legal_rep_last_name,
            'phone' => $request->legal_rep_phone_number,
            'email' => $request->legal_rep_email,
            'legal_status' => $request->legal_category,
            'holder_name' => $request->legal_category === 'Freehold' ? $request->freehold_certificate_holder_name : $request->leasehold_contract_holder_name,
            'holder_number' => $request->legal_category === 'Freehold' ? $request->freehold_certificate_number : $request->leasehold_contract_number,
            'start_date' => $request->leasehold_start_date ? $this->dateConversion($request->leasehold_start_date) : null,
            'end_date' => $request->leasehold_end_date ? $this->dateConversion($request->leasehold_end_date) : null,
            'purchase_date' => $request->freehold_purchase_date ? $this->dateConversion($request->freehold_purchase_date) : null,
            'extension_cost' => $this->convertToInteger($request->leasehold_negotiation_ext_cost),
            'purchase_cost' => $this->convertToInteger($request->leasehold_purchase_cost),
            'deadline_payment' => $request->leasehold_deadline_payment ? $this->dateConversion($request->leasehold_deadline_payment) : null,
            'zoning' => $request->legal_category === 'Freehold' ? $request->freehold_zoning : $request->leasehold_zoning,
        ]);

        // ========== UPDATE FINANCIAL ========== 
        LandFinancialModel::where('land_id', $id)->update([
            'average_price_status' => $request->average_price_status,
            'avg_nightly_rate' => $this->convertToInteger($request->average_nightly_rate),
            'avg_occupancy_rate' => $request->average_occupancy_rate,
            'find_property_of' => $request->find_property,
            'agent_name' => $request->agent_name,
            'agent_email' => $request->agent_email,
            'agent_phone' => $request->agent_whatsapp,
            'base_price_option' => $request->base_price,
            'base_price' => $this->convertToInteger($request->desire_price_from_the_owner),
            'desired_price_idr' => $this->convertToInteger($request->price_to_owner),
            'desired_price_usd' => $this->idrToUsdConvert($request->price_to_owner),
            'agent_commision' => $request->commission_of_the_agent,
            'give_balimmo_commision' => $request->full_commission_balimmo,
            'balimmo_commision' => $request->balimmo_commission,
            'selling_price_idr' => $this->convertToInteger($request->website_price),
            'selling_price_usd' => $this->idrToUsdConvert($request->website_price),
            'net_seller_idr' => $this->convertToInteger($request->net_profit),
            'net_seller_usd' => $this->idrToUsdConvert($request->net_profit),
        ]);

        // ========== UPDATE FEATURES ========== 
        LandFeatureModel::where('land_id', $id)->delete();
        if ($request->has('feature')) {
            foreach ($request->feature as $featureId) {
                $idFeature = LandFeatureListModel::select('id')->where('slug', $featureId)->first();
                if ($idFeature) {
                    LandFeatureModel::create([
                        'land_id' => $id,
                        'feature_land_id' => $idFeature->id,
                    ]);
                }
            }
        }

        // ========== UPDATE ATTACHMENTS ========== 
        $attachmentKeys = ['file_rental_support', 'file_type_of_mandate', 'url_virtual_tour', 'url_lifestyle', 'url_experience'];
        foreach ($attachmentKeys as $key) {
            $value = $request->input($key);
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $filename = $file->getClientOriginalName();
                $file->move(public_path('admin/attachment/' . $slug), $filename);
                $value = $filename;
            }

            if ($value !== null && $value !== '') {
                LandUrlAttachmentModel::updateOrCreate(
                    ['land_id' => $id, 'name' => $key],
                    ['path_attachment' => $value]
                );
            }
        }

        // ========== UPDATE GALLERY ========== 
        if ($request->has('old_images')) {
            $gallery = LandGalleryModel::firstOrCreate(['land_id' => $id], ['description' => 'land gallery']);
            foreach ($request->old_images as $index => $filename) {
                $existing = LandGalleryImageModel::where('land_gallery_id', $gallery->id)
                    ->where('image_path', 'admin/gallery/' . $slug . '/' . $filename)
                    ->first();
                if (!$existing) {
                    LandGalleryImageModel::create([
                        'land_gallery_id' => $gallery->id,
                        'image_path' => 'admin/gallery/' . $slug . '/' . $filename,
                        'order' => $index,
                        'is_featured' => $index === 0,
                    ]);
                }
            }
        }

        Cache::forget('land_list_cache');

        return redirect()->route('land.index')->with('flashData', [
            'judul' => 'Update Success',
            'pesan' => 'Land updated successfully',
            'swalFlashIcon' => 'success',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slug = LandModel::where('id', $id)->first();

        // Delete File Gallery
        if (file_exists(public_path('admin/gallery/' . $slug->land_slug))) {
            File::deleteDirectory(public_path('admin/gallery/' . $slug->land_slug));
        };

        // Delete File Attachment
        if (file_exists(public_path('admin/attachment/' . $slug->land_slug))) {
            File::deleteDirectory(public_path('admin/attachment/' . $slug->land_slug));
        };

        LandModel::destroy($id);

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Data Property Telah Dihapus',
            'swalFlashIcon' => 'success',
        ];

        Cache::forget('land_list_cache');

        return response()->json($flashData);
    }



    private function handleFileUpdate($request, $inputName, $folderPath, $propertyId)
    {
        if ($request->hasFile($inputName)) {
            // Cek jika sudah ada file lama
            $existing = LandUrlAttachmentModel::where('land_id', $propertyId)
                ->where('name', $inputName)
                ->first();

            if ($existing && $existing->path_attachment) {
                $oldPath = $folderPath . '/' . $existing->path_attachment;
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $newFile = $request->file($inputName);
            $filename = $newFile->getClientOriginalName();
            $newFile->move($folderPath, $filename);
            return $filename;
        }

        return null;
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
        while (LandModel::where('land_slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function idrToUsdConvert($idrValue)
    {
        $idrPrice = (int)preg_replace('/[^0-9]/', '', $idrValue);
        $usdPrice = round((float)$idrPrice / $this->getUSDtoIDRRate(), 2);

        return $usdPrice;
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

    public function changeAcceptance($slug, $status)
    {

        LandModel::where('land_slug', $slug)->update(
            [
                // 'type_acceptance' => $request->type_acceptance
                'type_acceptance' => $status
            ]
        );
        $flashData = [
            'judul' => 'Change Status Property Success',
            'pesan' => 'Property Status Changed Successfully',
            'swalFlashIcon' => 'success',
        ];

        // Hapus cache lama agar nanti di-refresh otomatis saat index() dipanggil lagi
        Cache::forget('land_list_cache');

        return redirect()->route('land.index')->with('flashData', $flashData);
    }

    // GalleryController.php
    public function uploadTemp(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $userFolder = 'tmp_uploads/' . Auth::user()->reference_code;

            $file->move(public_path($userFolder), $filename);

            session()->push('old_images', $filename); // simpan ke session
            return response()->json(['success' => true, 'filename' => $filename]);
        }

        return response()->json(['success' => false], 400);
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
}
