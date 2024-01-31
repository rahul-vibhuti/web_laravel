<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

ini_set('memory_limit', '-1');

trait FileUpload
{

    public function Upload($image, $folder)
    {
        $fileName = Str::random(30) .'.' . $image->getClientOriginalExtension();
        $image->storeAs('public/' . $folder, $fileName);
        return 'storage/' . $folder . '/' . $fileName;
    }


    public function imageThumbnail($image, $folder)
    {
        $manager = new ImageManager(new Driver());

        $imageName    = Str::random(30) . '.png';

        $folder = 'storage/' . $folder;

        $destinationPathThumbnail = public_path($folder);

        $image = $manager->read($image);

        $image->resize(190, 130, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail . '/' . $imageName);

        return   $folder  . '/' . $imageName;
    }
}
