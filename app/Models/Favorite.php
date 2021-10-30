<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable =[
        'customer_id',
        'specialist_id',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }
}
