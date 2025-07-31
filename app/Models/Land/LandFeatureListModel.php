<?php

namespace App\Models\Land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandFeatureListModel extends Model
{
    use HasFactory;
    protected $table = 'land_feature_list';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
