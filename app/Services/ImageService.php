<?php

namespace App\Services;

class ImageService
{
    public function save(string $path, $image)
    {
        $fileName = getNameFile($image);
        $image->move(public_path("uploads/$path"), $fileName);

        return $fileName;
    }
}
