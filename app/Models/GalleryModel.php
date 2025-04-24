<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{
    protected $table = 'gallery';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'email'];
    protected $primaryKey = 'id';
    use HasFactory;

    public function images(){
        return $this->hasMany(GalleryImageModel::class);
    }
}
