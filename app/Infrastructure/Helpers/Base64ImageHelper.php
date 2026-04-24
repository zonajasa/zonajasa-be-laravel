<?php

namespace App\Infrastructure\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Base64ImageHelper
{
    /**
     * @method Base64Image
     * @param $base64Image (base64 data format)
     * @param $prefix (main image)
     * @param $dir (lokasi tempat meyimpan gambar)
     */
    public static function Base64Image(string $base64Image, string $prefix, string $dir)
    {
        // Validasi format
        if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
            throw new \Exception('Invalid image format');
        }

        $imageType = strtolower($matches[1]);

        // Validasi extension
        $allowedTypes = ['jpeg', 'jpg', 'png'];
        if (!in_array($imageType, $allowedTypes)) {
            throw new \Exception('Only jpg, jpeg, png allowed');
        }

        // Ambil base64
        $imageBase64 = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
        $imageBase64 = str_replace(' ', '+', $imageBase64);

        $imageBinary = base64_decode($imageBase64);

        if ($imageBinary === false) {
            throw new \Exception('Invalid base64 data');
        }

        // Limit size (2MB)
        if (strlen($imageBinary) > 2 * 1024 * 1024) {
            throw new \Exception('Image too large (max 2MB)');
        }

        // Validasi MIME asli
        $finfo = finfo_open();
        $mime = finfo_buffer($finfo, $imageBinary, FILEINFO_MIME_TYPE);
        finfo_close($finfo);

        if (!in_array($mime, ['image/jpeg', 'image/png'])) {
            throw new \Exception('Invalid image content');
        }

        // Proses image
        $manager = new ImageManager(new Driver());
        $image = $manager->read($imageBinary);

        // Nama file
        $fileName = date('YmdHis') . '-' . uniqid() . '.webp';

        $directory = public_path($dir);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $fullPath = $directory . '/' . $fileName;

        // Convert webapp + compress
        $image->toWebp(75)->save($fullPath);

        return rtrim($dir, '/') . '/' . $fileName;
    }
}
