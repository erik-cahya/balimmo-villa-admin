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

    public function leads()
    {
        return $this->hasMany(PropertyLeadsModel::class, 'customer_id');
    }

    public function prospects()
    {
        return $this->hasMany(PropertyProspectModel::class , 'customer_id');
    }

    public function agen()
    {
        return User::where('reference_code' , $this->agent_code)->first();
    }
}
