<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDataModel extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
