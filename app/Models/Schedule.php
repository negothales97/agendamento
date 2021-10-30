<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'date',
        'init_hour',
        'final_hour',
        'specialist_id',
        'place_id',
        'transaction_status',
        'transaction_id',
        'agoraio_token',
        'agoraio_channel',
        'customer_id',
        'status',
        'price'
    ];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = formatDecimalToInteger($value);
    }
    public function setPlaceIdAttribute($value)
    {
        if ($value == 0) {
            $this->attributes['place_id'] = null;
        }
        $this->attributes['place_id'] = $value;
    }

    public function getPriceAttribute($value)
    {
        return formatIntegerToDecimal($value);
    }
}
