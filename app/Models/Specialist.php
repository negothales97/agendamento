<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;

class Specialist  extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'specialty_category_id',
        'specialty_id',
        'abstract',
        'picture',
        'use_online',
        'bank_code',
        'agencia',
        'agencia_dv',
        'conta',
        'conta_dv',
        'document_number',
        'recipient_id',
        'bank_account_id',
    ];
    protected $appends = [
        'image_url',
        'is_favorite',
        'specialty',
    ];
    protected $imageService;

    public function __construct(array $attributes = [])
    {
        $this->imageService = new ImageService();
        parent::__construct($attributes);
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'specialist_id');
    }

    public function getSpecialtyAttribute()
    {
        return $this->category->specialty;
    }

    public function category()
    {
        return $this->belongsTo(SpecialtyCategory::class, 'specialty_category_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Customer::class, 'favorites', 'specialist_id', 'customer_id')->withPivot('status');
    }

    public function setPictureAttribute($value)
    {
        if ($value !== null) {
            $path = 'specialist/';
            $this->attributes['picture'] =  $this->imageService->save($path, $value);
        }
    }
    public function getImageUrlAttribute()
    {
        return asset('uploads/specialist/') . '/' . $this->picture;
    }
    public function setPasswordAttribute($value)
    {
        if ($value != '') {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    public function setBankCodeAttribute($value)
    {
        $this->attributes['bank_code'] = Crypt::encryptString($value);
    }

    public function setAgenciaAttribute($value)
    {
        $this->attributes['agencia'] = Crypt::encryptString($value);
    }
    public function setAgenciaDvAttribute($value)
    {
        $this->attributes['agencia_dv'] = Crypt::encryptString($value);
    }
    public function setContaAttribute($value)
    {
        $this->attributes['conta'] = Crypt::encryptString($value);
    }
    public function setContaDvAttribute($value)
    {
        $this->attributes['conta_dv'] = Crypt::encryptString($value);
    }
    public function getBankCodeAttribute($value)
    {
        return  Crypt::decryptString($value);
    }

    public function getAgenciaAttribute($value)
    {
        return  Crypt::decryptString($value);
    }
    public function getAgenciaDvAttribute($value)
    {
        return  Crypt::decryptString($value);
    }
    public function getContaAttribute($value)
    {
        return  Crypt::decryptString($value);
    }
    public function getContaDvAttribute($value)
    {
        return  Crypt::decryptString($value);
    }

    public function getIsFavoriteAttribute()
    {
        $id = auth()->id();
        if ($id) {
            $favorite = $this->favorites()->where('customer_id', $id)->first();
            if ($favorite) {
                return $favorite->pivot->status === 1;
            }
        }
        return false;
    }
}
