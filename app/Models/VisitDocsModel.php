<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitDocsModel extends Model
{
    use HasFactory;

    protected $table = 'visit_docs';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';


    public function client()
    {
        return $this->belongsTo(ClientModel::class, 'client_id', 'id');
    }

    public function prospect()
    {
        return $this->belongsTo(PropertyProspectModel::class , 'prospect_id');
    }

    public function propertyVisitDocs()
    {
        return $this->hasMany(VisitPropertyDocsModel::class , 'docs_visit_id');
    }

    public function landVisitDocs()
    {
        return $this->hasMany(VisitLandDocsModel::class , 'docs_visit_id');
    }
}
