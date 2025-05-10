<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureListModel extends Model
{
    use HasFactory;
    protected $table = 'feature_list';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
