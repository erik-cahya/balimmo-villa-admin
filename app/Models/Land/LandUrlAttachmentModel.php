<?php

namespace App\Models\Land;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandUrlAttachmentModel extends Model
{
    use HasFactory;
    protected $table = 'land_url_attachment';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
