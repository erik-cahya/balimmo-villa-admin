<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesModel;
use App\Models\PropertyGalleryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;


class GalleryController extends Controller
{
    public function edit(PropertyGalleryModel $gallery)
    {
        $gallery->load(['images' => fn($q) => $q->orderBy('order')]);
        // dd($gallery);

        return view('admin.gallery.edit', compact('gallery'));
    }

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

        return redirect()->route('properties.index')->with('success', 'Gallery updated');
    }
}
