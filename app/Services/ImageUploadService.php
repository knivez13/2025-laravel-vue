<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public static function upload(string $string, string $location): string
    {
        $image_64 = $string;
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $imageName = Carbon::now()->format('YmdHis') . '.' . $extension;
        Storage::disk('public')->put('files/' . $location . '/' . $imageName, base64_decode($image));
        return request()->getSchemeAndHttpHost() . "/storage/files/'.$location.'/" . $imageName;
    }
}
