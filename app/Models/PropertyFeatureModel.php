<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFeatureModel extends Model
{
    use HasFactory;

    protected $table = 'property_feature';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
