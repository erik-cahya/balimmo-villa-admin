<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitPropertyDocsModel extends Model
{
    use HasFactory;

    protected $table = 'visit_property_docs';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
