<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFinancialModel extends Model
{
    use HasFactory;
    protected $table = 'property_financial';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
