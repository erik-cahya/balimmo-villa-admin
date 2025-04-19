<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaModel extends Model
{
    protected $table = 'villa';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    use HasFactory;
}
