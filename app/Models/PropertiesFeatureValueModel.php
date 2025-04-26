<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesFeatureValueModel extends Model
{
    protected $table = 'properties_feature_value';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    use HasFactory;
}
