<?php

namespace App\Http\Controllers;

use App\Models\GalleryImageModel;
use App\Models\GalleryModel;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('uploads', $filename, 'public');
            return response()->json(['path' => $path]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function submit(Request $request)
{
    $request->validate([
        'name' => 'required|unique:gallery',
        'email' => 'required|email',
        'gallery' => 'nullable|array',
        'gallery.*' => 'string',
    ]);

    $gallery = GalleryModel::create([
        'name' => $request->name,
        'email' => $request->email
    ]);

    if ($request->has('gallery')) {
        foreach ($request->gallery as $path) {
            GalleryImageModel::create([
                'gallery_id' => $gallery->id,
                'image' => $path,
            ]);
        }
    }

    return response()->json(['success' => true]);
}
}
