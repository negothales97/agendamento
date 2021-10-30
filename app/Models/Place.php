<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable =[
        'name',
        'street',
        'number',
        'district',
        'uf',
        'status',
        'city',
        'zip_code',
        'specialist_id',
    ];

    protected $appends = [
        'full_address'
    ];

    public function getFullAddressAttribute()
    {
        return "{$this->street}, {$this->number} - {$this->district} - {$this->city} - {$this->uf}";

    }


}
