<?php

namespace App\Models\Land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandModel extends Model
{
    protected $table = 'land';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    use HasFactory;

    // protected $casts = [
    //     'property_uuid' => 'string'
    // ];

    // PropertiesModel.php
    public function featuredImage()
    {
        return $this->hasOneThrough(
            LandGalleryImageModel::class,
            LandGalleryModel::class,
            'land_id', // Foreign key on PropertyGallery table
            'land_gallery_id',    // Foreign key on PropertyGalleryImage table
            'id',            // Local key on Properties table
            'id'             // Local key on PropertyGallery table
        );
    }
}
