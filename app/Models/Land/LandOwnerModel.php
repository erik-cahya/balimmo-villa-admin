<?php

namespace App\Models\Land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandOwnerModel extends Model
{
    protected $table = 'land_owner';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
