<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImageModel extends Model
{

    protected $table = 'gallery_images';
    protected $guarded = ['id'];
    // protected $fillable = ['name', 'email'];
    protected $primaryKey = 'id';
    use HasFactory;

    public function gallery()
    {
        return $this->belongsTo(GalleryModel::class);
    }
}
