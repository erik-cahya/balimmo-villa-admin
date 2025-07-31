<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyFeatureListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PropertiesFeatureController extends Controller
{
    public function index()
    {
        $data['feature_indoor'] = PropertyFeatureListModel::where('type', 'indoor')->get();
        $data['feature_outdoor'] = PropertyFeatureListModel::where('type', 'outdoor')->get();
        return view('admin.properties.feature-list.index', $data);
    }

    public function store(Request $request)
    {

        $baseSlug = Str::slug($request->name_category);
        $slug = $baseSlug;
        $counter = 2;

        // Cek property slug if exist in database
        while (PropertyFeatureListModel::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        PropertyFeatureListModel::create([
            'name' => $request->name_category,
            'slug' => $slug,
            'type' => $request->feature_category,
        ]);

        $flashData = [
            'judul' => 'Create Feature Property Success',
            'pesan' => 'New feature property successfully added',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('features.index')->with('flashData', $flashData);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $slug = Str::slug($request->name_category);

        PropertyFeatureListModel::where('id', $id)->update([
            'name' => $request->name_category,
            'slug' => $slug,
            'type' => $request->feature_category,
        ]);

        $flashData = [
            'judul' => 'Edit Feature Property Success',
            'pesan' => 'Feature property successfully Edited',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('features.index')->with('flashData', $flashData);
    }

    public function destroy($id)
    {
        PropertyFeatureListModel::destroy($id);

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Data Property Telah Dihapus',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }
}
