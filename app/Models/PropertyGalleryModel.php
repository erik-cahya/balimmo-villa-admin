<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGalleryModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'property_gallery';
    protected $primaryKey = 'id';

    public function images()
    {
        return $this->hasMany(PropertyGalleryImageModel::class, 'gallery_id');
    }
}
