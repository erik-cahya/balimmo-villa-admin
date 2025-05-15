<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertiesFeatureController extends Controller
{
    public function index(){
        return view('admin.properties.feature-list.index');
    }
}
