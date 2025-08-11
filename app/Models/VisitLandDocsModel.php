<?php

namespace App\Models;

use App\Models\Land\LandModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitLandDocsModel extends Model
{
    use HasFactory;

    protected $table = 'visit_land_docs';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function land()
    {
        return $this->belongsTo(LandModel::class , 'land_id');
    }
}
