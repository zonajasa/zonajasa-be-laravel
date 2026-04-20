<?php

namespace App\Infrastructure\Helpers;

/**
 * WhatsApp Helper Class
 * Provides utility functions for WhatsApp number formatting and validation
 */
class WhatsAppHelper
{
    /**
     * Format WhatsApp number from 08xx format to 628xx format
     * 
     * @param string $phoneNumber The phone number to format
     * @return string Formatted phone number with 62 prefix
     * 
     * @example
     * formatWhatsappNumber('08123456789') // Returns '628123456789'
     * formatWhatsappNumber('628123456789') // Returns '628123456789'
     * formatWhatsappNumber('+628123456789') // Returns '628123456789'
     */
    public static function formatWhatsappNumber($phoneNumber)
    {
        // Remove all non-digit characters
        $numbers = preg_replace('/\D/', '', $phoneNumber);

        // If starts with 0 (08xx), replace 0 with 62
        if (str_starts_with($numbers, '0')) {
            $numbers = '62' . substr($numbers, 1);
        }
        // If starts with 8 (no leading 0), add 62
        elseif (str_starts_with($numbers, '8')) {
            $numbers = '62' . $numbers;
        }
        // If doesn't start with 62, add it
        elseif (!str_starts_with($numbers, '62')) {
            $numbers = '62' . $numbers;
        }

        return $numbers;
    }

    /**
     * Validate WhatsApp number format
     * 
     * @param string $phoneNumber The phone number to validate
     * @return bool True if valid, false otherwise
     * 
     * @example
     * isValidWhatsappNumber('628123456789') // Returns true
     * isValidWhatsappNumber('08123456789') // Returns true (will be formatted)
     * isValidWhatsappNumber('123') // Returns false (too short)
     */
    public static function isValidWhatsappNumber($phoneNumber)
    {
        $formatted = self::formatWhatsappNumber($phoneNumber);
        $digits = preg_replace('/\D/', '', $formatted);

        // Valid WhatsApp number should be 11-13 digits (628xxxxxxxxxxxx format)
        return strlen($digits) >= 11 && strlen($digits) <= 14;
    }

    /**
     * Convert formatted number back to display format (08xx)
     * Useful for displaying to users in familiar format
     * 
     * @param string $phoneNumber The formatted phone number
     * @return string Display format (08xx)
     * 
     * @example
     * toDisplayFormat('628123456789') // Returns '08123456789'
     */
    public static function toDisplayFormat($phoneNumber)
    {
        $formatted = self::formatWhatsappNumber($phoneNumber);

        // Replace 62 prefix with 0
        if (str_starts_with($formatted, '62')) {
            return '0' . substr($formatted, 2);
        }

        return $formatted;
    }
}
