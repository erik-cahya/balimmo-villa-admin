<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesFeatureModel extends Model
{
    protected $table = 'properties_feature';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    use HasFactory;


    protected $casts = [
        'feature_value' => 'array'
    ];
}
