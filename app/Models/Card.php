<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected  $fillable =[
        'last_number',
        'exp_month',
        'exp_year',
        'holder_name',
        'card_id',
        'customer_id'
    ];
    protected $appends = [
        'formatted_expirate'
    ];

    public function getFormattedExpirateAttribute()
    {
        return "{$this->exp_month}/{$this->exp_year}";
    }
}
