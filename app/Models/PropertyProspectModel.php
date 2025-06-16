<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyProspectModel extends Model
{
    use HasFactory;

    protected $table = 'property_prospect';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
