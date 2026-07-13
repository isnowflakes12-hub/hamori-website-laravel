<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Compress and store an uploaded image.
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $disk
     * @param int $quality
     * @param int|null $maxWidth
     * @return string
     */
    public static function compressAndStore(UploadedFile $file, string $path, string $disk = 'public', int $quality = 75, ?int $maxWidth = 1920): string
    {
        // Check if the uploaded file is an image
        $mimeType = $file->getMimeType();
        if (!str_starts_with($mimeType, 'image/')) {
            // If it's not an image (e.g., PDF), just store it normally
            return $file->store($path, $disk);
        }

        // Initialize ImageManager with GD driver
        $manager = new ImageManager(new Driver());
        
        try {
            $image = $manager->read($file->getRealPath());

            // Resize if width is larger than max width
            if ($maxWidth !== null && $image->width() > $maxWidth) {
                $image->scaleDown(width: $maxWidth);
            }

            // Encode image as WebP for best compression/quality ratio
            // Webp encoding in Intervention Image v3
            $encoded = $image->toWebp($quality);

            // Generate filename with .webp extension
            $filename = Str::random(40) . '.webp';
            
            // Clean path
            $path = trim($path, '/');
            $fullPath = $path ? $path . '/' . $filename : $filename;

            // Store the encoded image
            Storage::disk($disk)->put($fullPath, (string) $encoded);

            return $fullPath;

        } catch (\Exception $e) {
            // Fallback to normal upload if intervention image fails
            return $file->store($path, $disk);
        }
    }
}
