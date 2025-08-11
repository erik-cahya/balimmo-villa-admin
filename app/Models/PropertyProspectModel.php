<?php

namespace App\Models;

use App\Models\Land\LandModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyProspectModel extends Model
{
    use HasFactory;

    protected $table = 'prospect';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function propertySelected()
    {
        return $this->hasMany(ProspectPropertySelectedModel::class , 'prospect_id');
    }

    public function landSelected()
    {
        return $this->hasMany(ProspectLandSelectedModel::class , 'prospect_id');
    }

    public function land()
    {
        return $this->belongsTo(LandModel::class , 'land_id');
    }

    public function property()
    {
        return $this->belongsTo(PropertiesModel::class, 'properties_id');
    }

    public function visitDocs()
    {
        return $this->hasMany(VisitDocsModel::class , 'prospect_id');
    }
}
