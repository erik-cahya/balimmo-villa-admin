<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureListModel;
use App\Models\RegionModel;
use App\Models\SubRegionModel;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index()
    {

        $data['region'] = RegionModel::get();
        $data['subRegion'] = SubRegionModel::get();
        return view('admin.localization.index', $data);
    }

    public function store(Request $request)
    {
        SubRegionModel::create([
            'region_id' => $request->region,
            'name' => $request->sub_region,
        ]);


        $flashData = [
            'judul' => 'Create Success',
            'pesan' => 'Sub Region Successfully Added',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('localization.index')->with('flashData', $flashData);
    }

    public function addRegion(Request $request)
    {
        RegionModel::create([
            'name' => $request->region,
        ]);


        $flashData = [
            'judul' => 'Create Success',
            'pesan' => '    Region Successfully Added',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('localization.index')->with('flashData', $flashData);
    }
}
