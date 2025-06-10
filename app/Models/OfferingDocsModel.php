<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferingDocsModel extends Model
{
    use HasFactory;

    protected $table = 'offering_docs';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
