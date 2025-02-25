<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Uploads an image to public/uploads/images and deletes the existing image if exists.
     *
     * @param UploadedFile|null $image
     * @param string $folder
     * @param string|null $existingImagePath
     * @return string|null
     */
    public static function uploadImage(?UploadedFile $image, $folder = 'images', $existingImagePath = null)
    {
        if (!$image) {
            return null;
        }

        // If there's an existing image, delete it
        if ($existingImagePath && Storage::disk('public')->exists($existingImagePath)) {
            Storage::disk('public')->delete($existingImagePath);
        }

        // Generate a unique file name
        $imageName = time() . '-' . $image->getClientOriginalName();

        // Store the new image in the public disk
        $path = $image->storeAs($folder, $imageName, 'public');

        return $path; // Return relative path
    }

    /**
     * Returns the full URL of the uploaded image or a default placeholder.
     *
     * @param string|null $path
     * @return string
     */
    public static function getImageUrl(?string $path)
    {
        return $path ? asset($path) : asset('default-image.png');
    }
}
