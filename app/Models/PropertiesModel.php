<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesModel extends Model
{
    protected $table = 'properties';
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
                PropertyGalleryImageModel::class,
                PropertyGalleryModel::class,
                'properties_id', // Foreign key on PropertyGallery table
                'gallery_id',    // Foreign key on PropertyGalleryImage table
                'id',            // Local key on Properties table
                'id'             // Local key on PropertyGallery table
            );
        }
}
