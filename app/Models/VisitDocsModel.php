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
}
