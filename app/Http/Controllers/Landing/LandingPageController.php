<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        return view('landing.index');
    }

    public function contact(){
        return view('landing.contact.index');
    }

    public function about(){
        return view('landing.about.index');
    }

    public function listing(){
        return view('landing.listing.index');
    }

    public function listingDetail(){
        return view('landing.listing.details');
    }

    public function blog(){
        return view('landing.blog.index');
    }
}
