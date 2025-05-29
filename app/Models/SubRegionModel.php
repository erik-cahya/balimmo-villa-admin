<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRegionModel extends Model
{
    use HasFactory;
    protected $table = 'sub_regions';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
