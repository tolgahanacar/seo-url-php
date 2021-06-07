<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function seolink($text){
    $find   = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
    $change = array("G","U","S","I","O","C","g","u","s","i","o","c");
    $text   = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$text);
    $text   = preg_replace($find,$change,$text);
    $text   = preg_replace("/ +/"," ",$text);
    $text   = preg_replace("/ /","-",$text);
    $text   = preg_replace("/\s/","",$text);
    $text   = strtolower($text);
    $text   = preg_replace("/^-/","",$text);
    $text   = preg_replace("/-$/","",$text);
    return $text;
}
