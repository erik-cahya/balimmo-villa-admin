<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectPropertySelectedModel extends Model
{
    use HasFactory;
    
    protected $table = 'prospect_properties_selected';
    protected $fillable = [
        'prospect_id',
        'properties_id'
    ];

    function prospect()
    {
        return $this->belongsTo(PropertyProspectModel::class , 'prospect_id');
    }

    function property()
    {
        return $this->belongsTo(PropertiesModel::class , 'properties_id');
    }
}
