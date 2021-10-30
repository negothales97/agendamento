<?php

namespace App\Models;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =[
        'title',
        'subtitle',
        'image',
        'content',
        'author',
    ];

    protected $appends = [
        'image_url',
    ];
    protected $imageService;

    public function __construct(array $attributes = [])
    {
        $this->imageService = new ImageService();
        parent::__construct($attributes);
    }

    public function setImageAttribute($value)
    {
        if ($value !== null) {
            $path = 'post/';
            $this->attributes['image'] =  $this->imageService->save($path, $value);
        }
    }
    public function getImageUrlAttribute()
    {
        return asset('uploads/post/').'/'.$this->image;
    }
}
