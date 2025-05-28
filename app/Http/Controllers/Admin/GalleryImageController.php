<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyGalleryImageModel;
use App\Models\PropertyGalleryModel;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    public function destroy($id)
    {
        $image = PropertyGalleryImageModel::findOrFail($id);

        // // Hapus file fisik
        // if (file_exists(public_path($image->image_path))) {
        //     unlink(public_path($image->image_path));
        // }

        $image->delete();

        return response()->json(['success' => true]);
    }
}
