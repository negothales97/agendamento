<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialtyCategory extends Model
{
    protected $fillable =[
        'name',
        'specialty_id'
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }
}
