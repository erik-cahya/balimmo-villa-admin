<?php

namespace App\Models\Land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandGalleryImageModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'land_gallery_image';
    protected $primaryKey = 'id';


    public function gallery()
    {
        return $this->belongsTo(LandGalleryModel::class);
    }
}
