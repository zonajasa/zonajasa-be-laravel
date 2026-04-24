<?php

use App\Infrastructure\Helpers\Base64ImageHelper;
use App\Infrastructure\Helpers\JsonBuilder;
use App\Infrastructure\Helpers\WhatsAppHelper;
use Illuminate\Http\JsonResponse;

// Global helper functions for WhatsApp formatting


if (!function_exists('formatWhatsappNumber')) {
    /**
     * Format WhatsApp number from 08xx to 628xx
     * 
     * @param string $phoneNumber
     * @return string
     */
    function formatWhatsappNumber($phoneNumber)
    {
        return WhatsAppHelper::formatWhatsappNumber($phoneNumber);
    }
}

if (!function_exists('isValidWhatsappNumber')) {
    /**
     * Validate WhatsApp number
     * 
     * @param string $phoneNumber
     * @return bool
     */
    function isValidWhatsappNumber($phoneNumber)
    {
        return WhatsAppHelper::isValidWhatsappNumber($phoneNumber);
    }
}

if (!function_exists('toDisplayFormat')) {
    /**
     * Convert formatted number to display format (08xx)
     * 
     * @param string $phoneNumber
     * @return string
     */
    function toDisplayFormat($phoneNumber)
    {
        return WhatsAppHelper::toDisplayFormat($phoneNumber);
    }
}

if (!function_exists('OkRes')) {
    /**
     * Format WhatsApp number from 08xx to 628xx
     * 
     * @param string $message
     * @param string $data
     * @param string $status
     * @return JsonResponse
     */
    function OkRes(string $message, $data, int $status = 200): JsonResponse
    {
        return JsonBuilder::OkRes($message, $data, $status);
    }
}

if (!function_exists('ErrorRes')) {
    /**
     * Format WhatsApp number from 08xx to 628xx
     * 
     * @param string $message
     * @param string $data
     * @param string $status
     * @return JsonResponse
     */
    function ErrorRes(string $message, int $status = 422): JsonResponse
    {
        return JsonBuilder::ErrorRes($message, $status);
    }
}

if (!function_exists('CustomError')) {
    /**
     * Format WhatsApp number from 08xx to 628xx
     * 
     * @param $validator
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    function CustomError($validator, string $message, int $status = 422): JsonResponse
    {
        return JsonBuilder::CustomError($validator, $message, $status);
    }
}


if (!function_exists('Base64Image')) {
    /**
     * @method Base64Image
     * @param $base64Image (base64 data format)
     * @param $prefix (main image)
     * @param $dir (lokasi tempat meyimpan gambar)
     */

    function Base64Image(string $base64Image, string $prefix, string $dir)
    {
        return Base64ImageHelper::Base64Image($base64Image, $prefix, $dir);
    }
}
