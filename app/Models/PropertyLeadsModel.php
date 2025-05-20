<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyLeadsModel extends Model
{
    use HasFactory;

    protected $table = 'property_leads';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
