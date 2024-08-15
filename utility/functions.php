<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function seolink($text) {
    $find = ["Ğ", "Ü", "Ş", "İ", "Ö", "Ç", "ğ", "ü", "ş", "ı", "ö", "ç"];
    $replace = ["G", "U", "S", "I", "O", "C", "g", "u", "s", "i", "o", "c"];
    $text = preg_replace("/[^0-9a-zA-Z]/", " ", $text);
    $text = str_replace($find, $replace, $text);
    $text = preg_replace("/\s+/", " ", $text);
    $text = trim($text);
    $text = strtolower($text);
    $text = preg_replace("/\s+/", "-", $text);
    return $text;
}
?>
