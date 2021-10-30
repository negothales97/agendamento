<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $fillable = [
        'mins_available_after_closing',
        'tolerance_mins',
        'percentage',
        'chargeback_1',
        'chargeback_2',
        'chargeback_3',
        'chargeback_4',
    ];

    public function setPercentageAttribute($value)
    {
        $this->attributes['percentage'] = formatDecimalToInteger($value);
    }
    public function setChargeback1Attribute($value)
    {
        $this->attributes['chargeback_1'] = formatDecimalToInteger($value);
    }
    public function setChargeback2Attribute($value)
    {
        $this->attributes['chargeback_2'] = formatDecimalToInteger($value);
    }
    public function setChargeback3Attribute($value)
    {
        $this->attributes['chargeback_3'] = formatDecimalToInteger($value);
    }
    public function setChargeback4Attribute($value)
    {
        $this->attributes['chargeback_4'] = formatDecimalToInteger($value);
    }

    public function getPercentageAttribute($value)
    {
        return formatIntegerToDecimal($value);
    }

    public function getChargeback1Attribute($value)
    {
        return formatIntegerToDecimal($value);
    }
    public function getChargeback2Attribute($value)
    {
        return formatIntegerToDecimal($value);
    }
    public function getChargeback3Attribute($value)
    {
        return formatIntegerToDecimal($value);
    }
    public function getChargeback4Attribute($value)
    {
        return formatIntegerToDecimal($value);
    }
}
