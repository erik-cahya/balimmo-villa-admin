<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFeatureListModel extends Model
{
    use HasFactory;
    protected $table = 'property_feature_list';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
