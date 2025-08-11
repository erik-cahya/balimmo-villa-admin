<?php

namespace App\Models;

use App\Models\Land\LandModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectLandSelectedModel extends Model
{
    use HasFactory;
    
    protected $table = 'prospect_land_selected';
    protected $fillable = [
        'prospect_id',
        'land_id'
    ];

    function prospect()
    {
        return $this->belongsTo(PropertyProspectModel::class , 'prospect_id');
    }

    function land()
    {
        return $this->belongsTo(LandModel::class , 'land_id');
    }
}
