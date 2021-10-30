<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'background',
        'background_image'
    ];

    protected $appends = [
        'image_url',
        'background_image_url'
    ];
    protected $imageService;

    public function __construct(array $attributes = [])
    {
        $this->imageService = new ImageService();
        parent::__construct($attributes);
    }

    public function categories()
    {
        return $this->hasMany(SpecialtyCategory::class);
    }

    public function setIconAttribute($value)
    {
        if ($value !== null) {
            $path = 'specialty/';
            $this->attributes['icon'] =  $this->imageService->save($path, $value);
        }
    }
    public function setBackgroundImageAttribute($value)
    {
        if ($value !== null) {
            $path = 'specialty/';
            $this->attributes['background_image'] =  $this->imageService->save($path, $value);
        }
    }
    public function getImageUrlAttribute()
    {
        return asset('uploads/specialty') . "/" . $this->icon;
    }
    public function getBackgroundImageUrlAttribute()
    {
        return asset('uploads/specialty') . "/" . $this->background_image;
    }
}
