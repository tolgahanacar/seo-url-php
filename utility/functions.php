<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/**
 * Generates an SEO-friendly URL slug from a given text.
 *
 * @param string $text The input string to convert.
 * @return string The URL-safe slug.
 */
function seolink(string $text): string {
    // Map both upper and lowercase Turkish characters directly to lowercase Latin characters
    $find = ["Ğ", "Ü", "Ş", "İ", "Ö", "Ç", "ğ", "ü", "ş", "ı", "ö", "ç"];
    $replace = ["g", "u", "s", "i", "o", "c", "g", "u", "s", "i", "o", "c"];
    
    // 1. Replace Turkish characters with lowercase Latin equivalents first
    $text = str_replace($find, $replace, $text);
    
    // 2. Convert remaining standard Latin characters to lowercase
    $text = strtolower($text);
    
    // 3. Remove any characters that are not lowercase alphanumeric, spaces, or hyphens
    $text = preg_replace("/[^a-z0-9\s-]/", "", $text);
    
    // 4. Compress multiple spaces or hyphens to a single space
    $text = preg_replace("/[\s-]+/", " ", $text);
    
    // 5. Trim whitespace
    $text = trim($text);
    
    // 6. Replace spaces with a single hyphen
    $text = str_replace(" ", "-", $text);
    
    return $text;
}
