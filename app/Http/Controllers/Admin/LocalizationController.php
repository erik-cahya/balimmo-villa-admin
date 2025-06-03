<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureListModel;
use App\Models\RegionModel;
use App\Models\SubRegionModel;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:Master');
    // }
    public function index()
    {
        $data['feature_indoor'] = FeatureListModel::where('type', 'indoor')->get();
        $data['feature_outdoor'] = FeatureListModel::where('type', 'outdoor')->get();

        $data['region'] = RegionModel::get();
        $data['subRegion'] = SubRegionModel::get();
        return view('admin.localization.index', $data);
    }
}
