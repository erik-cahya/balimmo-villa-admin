<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertiesFileModel extends Model
{
    use HasFactory;

    protected $table = 'properties_file';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
