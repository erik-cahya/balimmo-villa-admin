<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesModel;
use App\Models\PropertyGalleryImageModel;
use App\Models\PropertyGalleryModel;

use App\Models\Land\LandModel;
use App\Models\Land\LandGalleryImageModel;
use App\Models\Land\LandGalleryModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;


class GalleryController extends Controller
{
    public function edit(PropertyGalleryModel $gallery)
    {
        $propertyName = PropertiesModel::where('id', $gallery->properties_id)->value('property_name');
        $slug = PropertiesModel::where('id', $gallery->properties_id)->value('property_slug');

        $gallery->load(['images' => fn($q) => $q->orderBy('order')]);

        return view('admin.properties.gallery.edit', compact(['gallery', 'propertyName', 'slug']));
    }

    // public function editland(LandGalleryModel $gallery)
    // {
    //     $landName = LandModel::where('id', $gallery->land_id)->value('land_name');
    //     $slug = LandModel::where('id', $gallery->land_id)->value('land_slug');

    //     $gallery->load(['images' => fn($q) => $q->orderBy('order')]);

    //     return view('admin.land.gallery.edit', compact(['gallery', 'landName', 'slug']));
    // }

    public function update(Request $request, PropertyGalleryModel $gallery)
    {
        // dd($gallery->properties_id);
        $slug = PropertiesModel::where('id', $gallery->properties_id)->value('property_slug');
        // dd($request->all());
        $gallery->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Update existing images order
        $order = explode(',', $request->order ?? '');
        foreach ($order as $i => $imageId) {
            $image = $gallery->images()->where('id', $imageId)->first();
            if ($image) {
                $image->update([
                    'order' => $i,
                    'is_featured' => $i === 0,
                ]);
            }
        }

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/admin/gallery/' . $slug), $filename);

                $gallery->images()->create([
                    'image_path' => 'admin/gallery/' . $slug . '/' . $filename,
                    'order' => $gallery->images()->count(),
                    'is_featured' => false,
                ]);
            }
        }

        Cache::forget('properties_list_cache');

        $flashData = [
            'judul' => 'Edit Gallery Success',
            'pesan' => 'Gallery edited successfully',
            'swalFlashIcon' => 'success',
        ];
        // return back()->with('flashData', $flashData);
        // return redirect()->route('properties.index')->with('success', 'Gallery updated');

        $slug = PropertiesModel::where('id', $gallery->properties_id)->value('property_slug');
        return redirect()->route('properties.edit', $slug)
            ->with('flashData', $flashData);
    }

    public function destroy($id)
    {
        $image = PropertyGalleryModel::findOrFail($id);

        // Hapus file fisik
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

    public function deleteImage($id)
    {

        $image = PropertyGalleryImageModel::findOrFail($id);

        // // Hapus file fisik
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }
        $image->delete();
        return response()->json(['success' => true]);

        // Cache::forget('properties_list_cache');
    }

    public function editland(LandGalleryModel $gallery)
    {
        $landName = LandModel::where('id', $gallery->land_id)->value('land_name');
        $slug = LandModel::where('id', $gallery->land_id)->value('land_slug');

        $gallery->load(['images' => fn($q) => $q->orderBy('order')]);

        return view('admin.land.gallery.edit', compact(['gallery', 'landName', 'slug']));
    }

    public function updateland(Request $request, LandGalleryModel $gallery)
    {
        $slug = LandModel::where('id', $gallery->land_id)->value('land_slug');

        // Urutkan existing images sesuai order dari client
        $order = array_filter(explode(',', $request->order ?? ''), fn($v) => $v !== '');
        foreach ($order as $i => $imageId) {
            $image = $gallery->images()->where('id', (int)$imageId)->first();
            if ($image) {
                $image->update([
                    'order'       => $i,
                    'is_featured' => $i === 0,
                ]);
            }
        }

        // Upload gambar baru
        if ($request->hasFile('images')) {
            // hitung start index berdasarkan jumlah existing image setelah re-order
            $start = $gallery->images()->count();
            foreach ($request->file('images') as $idx => $image) {
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/admin/gallery/' . $slug), $filename);

                $gallery->images()->create([
                    'image_path'  => 'admin/gallery/' . $slug . '/' . $filename,
                    'order'       => $start + $idx,
                    'is_featured' => false,
                ]);
            }
        }

        Cache::forget('land_list_cache');

        return redirect()
            ->route('land.edit', $slug)
            ->with('flashData', [
                'judul' => 'Edit Gallery Success',
                'pesan' => 'Gallery edited successfully',
                'swalFlashIcon' => 'success',
            ]);
    }

    public function deleteImageland($id)
    {
        $image = \App\Models\Land\LandGalleryImageModel::findOrFail($id);

        if (file_exists(public_path($image->image_path))) {
            @unlink(public_path($image->image_path));
        }

        $galleryId = $image->land_gallery_id;
        $image->delete();

        // rapikan ulang order & featured
        $siblings = \App\Models\Land\LandGalleryImageModel::where('land_gallery_id', $galleryId)
            ->orderBy('order')
            ->get();

        foreach ($siblings as $i => $img) {
            $img->update([
                'order'       => $i,
                'is_featured' => $i === 0,
            ]);
        }

        return response()->json(['success' => true]);
    }

}
