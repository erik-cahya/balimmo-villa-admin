<?php

namespace App\Http\Controllers;

use App\Models\RegionModel;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getRegions()
    {
        $regions = RegionModel::with('subRegions')->get();

        // Format ulang agar seperti JSON asli
        $formatted = [];
        foreach ($regions as $region) {
            $formatted[strtolower($region->name)] = $region->subRegions->pluck('name')->toArray();
        }

        return response()->json($formatted);
    }
}
