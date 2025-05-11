<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGalleryImageModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'property_gallery_image';
    protected $primaryKey = 'id';


    public function gallery()
    {
        return $this->belongsTo(PropertyGalleryModel::class);
    }
}
