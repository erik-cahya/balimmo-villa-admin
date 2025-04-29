<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesModel extends Model
{
    protected $table = 'properties';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    use HasFactory;

    protected $casts = [
        'property_uuid' => 'string'
    ];
}
