<?php

namespace App\Models\Land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandFeatureModel extends Model
{
    use HasFactory;

    protected $table = 'land_feature';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
