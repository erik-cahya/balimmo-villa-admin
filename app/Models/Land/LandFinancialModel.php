<?php

namespace App\Models\Land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandFinancialModel extends Model
{
    use HasFactory;
    protected $table = 'land_financial';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
