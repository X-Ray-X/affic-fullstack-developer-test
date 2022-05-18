<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Handles base64 decoding, determines file extension and saves the image to the public storage space.
     *
     * @param string $encodedImage
     * @param string $fileName
     * @param string $pathPrefix
     * @return string
     */
    public static function saveBase64Image(string $encodedImage, string $fileName, string $pathPrefix = 'images/'): string
    {
        $imageData = base64_decode($encodedImage);

        $resource = finfo_open();

        $mimeType = finfo_buffer($resource, $imageData, FILEINFO_MIME_TYPE);

        $fileExtension = explode('/', $mimeType);

        $imagePath = 'public/' . $pathPrefix . $fileName . '.' . $fileExtension[1];

        Storage::put($imagePath, $imageData);

        return $imagePath;
    }
}
