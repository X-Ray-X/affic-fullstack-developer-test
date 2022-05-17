<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * @param string $encodedImage
     * @param string $fileName
     * @param string $pathPrefix
     * @return string
     */
    public static function saveBase64Image(string $encodedImage, string $fileName, string $pathPrefix = 'public/images/'): string
    {
        $imageData = base64_decode($encodedImage);

        $f = finfo_open();

        $mimeType = finfo_buffer($f, $imageData, FILEINFO_MIME_TYPE);

        $fileExtension = explode('/', $mimeType);

        $imagePath = $pathPrefix . $fileName . '.' . $fileExtension[1];

        Storage::put($imagePath, $imageData);

        return $imagePath;
    }
}
