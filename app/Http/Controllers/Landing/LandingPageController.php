<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\FeatureListModel;
use App\Models\PropertiesModel;
use App\Models\PropertyFeatureModel;
use App\Models\PropertyGalleryImageModel;
use App\Models\PropertyUrlAttachmentModel;
use App\Models\RegionModel;
use App\Models\SubRegionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class LandingPageController extends Controller
{
    public function index()
    {
        $properties = Cache::rememberForever('properties_list_cache', function () {
            $data_property = PropertiesModel::select(
                'properties.id',
                'total_land_area',
                'property_name',
                'property_slug',
                'internal_reference',
                'bedroom',
                'bathroom',
                'sub_region',
                'property_address',
                'users.name as agent_name',
                'users.profile as profilePicture',
                'users.reference_code as referenceCode',
                'property_financial.selling_price_idr',
                'property_financial.selling_price_usd',
            )
                ->where('type_acceptance', 'Accept')
                ->join('users', 'reference_code', '=', 'properties.internal_reference')
                ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                ->with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'property_gallery.id');
                    $query->where('is_featured', 1);
                }])
                ->get();

            // Format harga
            foreach ($data_property as $item) {
                $item->formatted_price = $this->shortPriceIDR($item->selling_price_idr);
            }

            return $data_property;
        });

        // Simpan ke variabel untuk view
        $data['data_property'] = $properties;
        $data['sub_regions'] = SubRegionModel::select('name')->get();
        $data['feature_list'] = FeatureListModel::get();

        // Cache::forget('properties_list_cache');
        return view('landing.index', $data);
    }


    private function shortPriceIDR($priceIDR)
    {
        if ($priceIDR >= 1000000000) {
            return 'Rp ' . number_format($priceIDR / 1000000000, 1) . 'B';
        } elseif ($priceIDR >= 1000000) {
            return 'Rp ' . number_format($priceIDR / 1000000, 1) . 'M';
        } elseif ($priceIDR >= 1000) {
            return 'Rp ' . number_format($priceIDR / 1000, 0) . 'K';
        } else {
            return 'Rp ' . number_format($priceIDR, 0, ',', '.');
        }
    }

    public function listing()
    {
        $properties = Cache::rememberForever('properties_list_cache', function () {

            $data_property = PropertiesModel::select(
                'properties.id',
                'total_land_area',
                'property_name',
                'property_slug',
                'internal_reference',
                'sub_region',
                'bedroom',
                'bathroom',
                'property_address',
                'property_financial.selling_price_idr',
                'property_financial.selling_price_usd',

            )->where('properties.type_acceptance', 'accept')
                ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                ->with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'property_gallery.id');
                    $query->where('is_featured', 1);
                }])
                ->get();

            foreach ($data_property as $item) {
                $item->formatted_price = $this->shortPriceIDR($item->selling_price_idr);
            }
            return $data_property;
        });

        $data['data_property'] = $properties;
        $data['regions'] = RegionModel::select('name')->get();

        return view('landing.listing.index', $data);
    }

    public function listingDetail($slug)
    {
        $data['property'] = PropertiesModel::where('property_slug', $slug)
            ->select(
                'properties.*',
                'users.name as agent_name',
                'users.reference_code as agent_code',
                'users.email as agent_email',
                'users.description as agent_description',
                'users.tagline as agent_tagline',
                'users.profile as profilePicture',
                'property_legal.legal_status as legalStatus',
                'property_financial.selling_price_idr',
                'property_financial.selling_price_usd',
            )
            ->join('users', 'reference_code', '=', 'properties.internal_reference')
            ->join('property_legal', 'property_legal.properties_id', '=', 'properties.id')
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->with(['featuredImage' => function ($query) {
                $query->select('image_path', 'property_gallery.id');
                $query->where('is_featured', 1);
            }])->first();

        if ($data['property'] == null) {
            return view('error.404');
        };


        $data['image_gallery'] = PropertyGalleryImageModel::where('gallery_id', $data['property']['featuredImage']->id)->get();

        $data['feature_list'] = PropertyFeatureModel::where('properties_id', $data['property']->id)
            ->join('feature_list', 'feature_list.id', '=', 'property_feature.feature_id')
            ->select('feature_list.name as feature_name')->get();

        $url_attachment = PropertyUrlAttachmentModel::where('properties_id', $data['property']->id)->get();

        foreach ($url_attachment as $url) {
            if ($url->name === 'url_virtual_tour') {
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url->path_attachment, $match);
                $url->path_attachment = $match[1];
            } elseif ($url->name === 'url_lifestyle') {
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url->path_attachment, $match);
                $url->path_attachment = $match[1];
            } elseif ($url->name === 'url_experience') {
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url->path_attachment, $match);
                $url->path_attachment = $match[1];
            }
        }
        $data['attachment'] = collect($url_attachment);
        $data['regions'] = RegionModel::select('name')->get();


        if ($data['property']->type_acceptance == 'accept') {

            $data['other_properties'] = PropertiesModel::where('internal_reference', $data['property']->internal_reference)->where('properties.id', '!=', $data['property']->id)->where('type_acceptance', 'accept')
                ->with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'property_gallery.id');
                    $query->where('is_featured', 1);
                }])
                ->inRandomOrder()
                ->limit(2)
                ->get();

            return view('landing.listing.details', $data);
        } else {
            return abort(404);
        }
    }

    public function contact()
    {
        $data['sub_regions'] = SubRegionModel::select('name')->get();
        return view('landing.contact.index', $data);
    }

    public function about()
    {
        return view('landing.about.index');
    }

    public function blog()
    {
        return view('landing.blog.index');
    }

    public function login()
    {
        return view('landing.login.index');
    }
    public function signup()
    {
        return view('landing.sign-up.index');
    }

    // ======================================================
    // Search / Filter in listing page
    // ======================================================
    public function search(Request $request)
    {
        $query = $request->get('query');
        $bedroom = $request->get('bedroom');
        $propertyTypes = $request->get('property_type', []);
        $locations = $request->get('location', []);

        // Jika semua filter kosong gunakan query from cache
        if (empty($query) && empty($bedroom) && empty($propertyTypes) && empty($locations)) {
            $data_property = Cache::rememberForever('properties_list_cache', function () {
                return PropertiesModel::with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'property_gallery.id');
                    $query->where('is_featured', 1);
                }])->where('type_acceptance', 'Accept')
                    ->join('property_legal', 'property_legal.properties_id', '=', 'properties.id')
                    ->get();
            });
        } else {
            $data_property = PropertiesModel::with(['featuredImage' => function ($query) {
                $query->select('image_path', 'property_gallery.id');
                $query->where('is_featured', 1);
            }])
                ->join('property_legal', 'property_legal.properties_id', '=', 'properties.id')
                ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                ->where('type_acceptance', 'Accept')
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($q2) use ($query) {
                        $q2->where('property_name', 'like', "%{$query}%")
                            ->orWhere('property_address', 'like', "%{$query}%");
                    });
                })
                ->when($bedroom, fn($q) => $q->where('bedroom', '=', $bedroom))
                ->when($propertyTypes, fn($q) => $q->whereIn('legal_status', $propertyTypes))
                ->when($locations, fn($q) => $q->whereIn('region', $locations))
                ->get();
        }

        return view('landing.listing.partials.property_list', compact('data_property'))->render();
    }


    // ======================================================
    // Search / Filter in landing page
    // ======================================================
    public function filter(Request $request)
    {
        // dd($request->all());


        $name = $request->name;
        $propertyType = $request->property_type;
        $location = $request->location;

        $priceMin = (int)preg_replace('/[^0-9]/', '', $request->priceMin);
        $priceMax = (int)preg_replace('/[^0-9]/', '', $request->priceMax);
        $yearBuild = $request->year_build;
        $bathroom = $request->bathroom;
        $bedroom = $request->bedroom;
        $propertyCode = $request->property_code;


        $featureIds = $request->input('features');

        $propertyIds = []; // Default kosong
        if ($featureIds && count($featureIds) > 0) {
            $propertyIds = DB::table('property_feature')
                ->select('properties_id')
                ->whereIn('feature_id', $featureIds)
                ->groupBy('properties_id')
                ->havingRaw('COUNT(DISTINCT feature_id) = ?', [count($featureIds)])
                ->pluck('properties_id')
                ->toArray();

            // Jika ada fitur dipilih, tapi hasilnya kosong, maka langsung return kosong
            if (empty($propertyIds)) {
                $data['data_property'] = collect(); // kosongkan collection
                return view('landing.search.index', $data);
            }
        }

        // dd($propertyIds);

        $data['data_property'] = PropertiesModel::with(['featuredImage' => function ($query) {
            $query->select('image_path', 'property_gallery.id');
            $query->where('is_featured', 1);
        }])
            ->select(
                'properties.*',
                'property_financial.selling_price_idr',
                'property_legal.legal_status'
            )
            ->when(
                $name,
                fn($query, $name) => $query->where('property_name', 'like', "%{$name}%")
            )
            ->join('property_legal', 'property_legal.properties_id', '=', 'properties.id')
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')

            ->when($location, fn($q, $location) => $q->where('sub_region', $location))
            ->when($propertyType, fn($q, $propertyType) => $q->where('legal_status', 'like', "%{$propertyType}%"))
            ->when($yearBuild, fn($q, $yearBuild) => $q->where('year_construction', 'like', "%{$yearBuild}%"))
            ->when($bathroom, fn($q, $bathroom) => $q->where('bathroom', 'like', "%{$bathroom}%"))
            ->when($bedroom, fn($q, $bedroom) => $q->where('bedroom', 'like', "%{$bedroom}%"))
            ->when($priceMin, fn($q) => $q->where('property_financial.selling_price_idr', '>=', $priceMin))
            ->when($priceMax, fn($q) => $q->where('property_financial.selling_price_idr', '<=', $priceMax))
            ->when($propertyCode, fn($q, $propertyCode) => $q->where('property_code', 'like', "%{$propertyCode}%"))
            ->when(count($propertyIds) > 0, fn($q) => $q->whereIn('properties.id', $propertyIds)) // 💡 Gabung ke filter berdasarkan fitur
            ->get();

        // dd($location);
        // dd($data['data_property']);

        return view('landing.search.index', $data);
    }
}
