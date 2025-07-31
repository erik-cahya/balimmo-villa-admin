<?php

namespace App\Models\Land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandGalleryModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'land_gallery';
    protected $primaryKey = 'id';

    public function images()
    {
        return $this->hasMany(LandGalleryImageModel::class, 'land_gallery_id');
    }
}
