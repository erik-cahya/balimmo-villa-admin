<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\PropertiesModel;
use App\Models\PropertyGalleryImageModel;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){

        $data['data_property'] = 
            PropertiesModel::select('properties.id','total_land_area', 'property_name', 'property_slug', 'internal_reference', 'bedroom', 'bathroom', 'property_address', 'users.name as agent_name')
            ->join('users', 'reference_code', '=', 'properties.internal_reference')
            ->with(['featuredImage' => function ($query) {
                $query->select('image_path', 'property_gallery.id');
                $query->where('is_featured', 1);
            }])
            ->get();

        // dd($data['data_property']);

        return view('landing.index', $data);
    }

     public function listing(){
        $data['data_property'] = 
            PropertiesModel::select('properties.id','total_land_area', 'property_name', 'property_slug', 'internal_reference', 'bedroom', 'bathroom', 'property_address', 'users.name as agent_name')
            ->join('users', 'reference_code', '=', 'properties.internal_reference')
            ->with(['featuredImage' => function ($query) {
                $query->select('image_path', 'property_gallery.id');
                $query->where('is_featured', 1);
            }])
            ->get();

        return view('landing.listing.index', $data);
    }

    public function listingDetail($slug){
        // dd($slug);
        $data['property'] = PropertiesModel::where('property_slug', $slug)
            ->select('properties.*', 'users.name as agent_name', 'users.email as agent_email', 'property_legal.legal_status as legalStatus')
            ->join('users', 'reference_code', '=', 'properties.internal_reference')    
            ->join('property_legal', 'properties_id', '=', 'properties.id')    
            ->with(['featuredImage' => function ($query) {
                $query->select('image_path', 'property_gallery.id');
                $query->where('is_featured', 1);
            }])
            ->first();

        $data['image_gallery'] = PropertyGalleryImageModel::where('gallery_id', $data['property']['featuredImage']->id)->get();

        // dd($data['image_gallery']);


        return view('landing.listing.details', $data);
    }

    public function contact(){
        return view('landing.contact.index');
    }

    public function about(){
        return view('landing.about.index');
    }

   

    public function blog(){
        return view('landing.blog.index');
    }

    public function login(){
        return view('landing.login.index');
    }
    public function signup(){
        return view('landing.sign-up.index');
    }
}
