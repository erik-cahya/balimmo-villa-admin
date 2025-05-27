<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\PropertiesModel;
use App\Models\PropertyFeatureModel;
use App\Models\PropertyGalleryImageModel;
use App\Models\PropertyUrlAttachmentModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
                'region',
                'property_address',
                'users.name as agent_name',
                'users.profile as profilePicture',
                'users.reference_code as referenceCode',
                'property_financial.selling_price_idr as sellingPriceIDR'
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
                $item->formatted_price = $this->shortPriceIDR($item->sellingPriceIDR);
            }

            return $data_property; // ← PENTING: pastikan return!
        });

        // Simpan ke variabel untuk view
        $data['data_property'] = $properties;

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

            $data_property =
                PropertiesModel::select(
                    'properties.id',
                    'total_land_area',
                    'property_name',
                    'property_slug',
                    'internal_reference',
                    'region',
                    'bedroom',
                    'bathroom',
                    'property_address',
                    'property_financial.selling_price_idr as sellingPriceIDR'
                )->where('properties.type_acceptance', 'accept')
                ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
                ->with(['featuredImage' => function ($query) {
                    $query->select('image_path', 'property_gallery.id');
                    $query->where('is_featured', 1);
                }])
                ->get();

            foreach ($data_property as $item) {
                $item->formatted_price = $this->shortPriceIDR($item->sellingPriceIDR);
            }
            return $data_property;
        });

        $data['data_property'] = $properties;

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
                'property_financial.selling_price_idr as sellingPriceIDR',
            )
            ->join('users', 'reference_code', '=', 'properties.internal_reference')
            ->join('property_legal', 'property_legal.properties_id', '=', 'properties.id')
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->with(['featuredImage' => function ($query) {
                $query->select('image_path', 'property_gallery.id');
                $query->where('is_featured', 1);
            }])->first();

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

        if ($data['property']->type_acceptance == 'accept') {
            return view('landing.listing.details', $data);
        } else {
            return abort(404);
        }
    }

    public function contact()
    {
        return view('landing.contact.index');
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

    public function search(Request $request)
    {
        $query = $request->get('query');
        // $priceMin = $request->get('price_min');
        // $priceMax = $request->get('price_max');
        $bedroom = $request->get('bedroom');
        $propertyTypes = $request->get('property_type', []);
        $locations = $request->get('location', []);

        $data_property = PropertiesModel::with('featuredImage')
            ->where('type_acceptance', 'Accept')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q2) use ($query) {
                    $q2->where('property_name', 'like', "%{$query}%")
                        ->orWhere('property_address', 'like', "%{$query}%");
                });
            })
            // ->when($priceMin, fn($q) => $q->where('property_financial.selling_price_idr', '>', (int)$priceMin))
            // ->when($priceMax, fn($q) => $q->where('property_financial.selling_price_idr', '<', (int)$priceMax))
            ->when($bedroom, fn($q) => $q->where('bedroom', '=', $bedroom))
            ->when($propertyTypes, fn($q) => $q->whereIn('legal_status', $propertyTypes))
            ->when($locations, fn($q) => $q->whereIn('region', $locations))
            ->join('property_legal', 'property_legal.properties_id', '=', 'properties.id')
            // ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->get();

        return view('landing.listing.partials.property_list', compact('data_property'))->render();
    }
}
