<?php

namespace App\Models\Land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandLegalModel extends Model
{
    use HasFactory;

    protected $table = 'land_legal';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
