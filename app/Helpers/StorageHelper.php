<?php

namespace App\Helpers;

use Gumlet\ImageResize;
use Gumlet\ImageResizeException;
use Illuminate\Support\Facades\Log;
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

        $imagePath = 'storage/' . $pathPrefix . $fileName . '.' . $fileExtension[1];

        Storage::put($imagePath, $imageData);

        try {
            $imageResize = new ImageResize($imagePath);
            $imageResize->crop(
                env('IMAGE_CROP_SIZE_WIDTH', 1920),
                env('IMAGE_CROP_SIZE_HEIGHT', 1080),
                env('IMAGE_ALLOW_ENLARGE', true))
            ;
            $imageResize->save($imagePath);
        } catch (ImageResizeException $exception) {
            Log::error($exception->getMessage(), [
                'image' => $imagePath,
            ]);
        }

        return $imagePath;
    }
}
