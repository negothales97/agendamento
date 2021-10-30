<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'first_name',
        'last_name',
        'cellphone',
        'document',
        'email',
        'balance',
        'popup_notification',
        'reminder_time',
        'password',
    ];
    protected $appends = [
        'full_name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function setPasswordAttribute($value)
    {
        if ($value != '') {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function getFullNameAttribute($value)
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function setCellphoneAttribute($value){
        $this->attributes['cellphone']= clearSpecialCaracteres($value);
    }
    public function setDocumentAttribute($value){
        $this->attributes['document']= clearSpecialCaracteres($value);
    }
}
