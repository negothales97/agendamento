<?php
function clearSpecialCaracteres($string = '')
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    $specialCaracteres = ['“', '‘', '!', '@', '#', '$', '%', '&', '*', '(', ')', '_', '-', '+', '=', '{', '[', '}', ']', '|', '<', '>', '.', ':', ';', '?', '/'];
    return str_replace($specialCaracteres, "", $string);
}

function getNameFile($originalImage = null)
{
    $ext = '.webp';
    $fileName = md5(uniqid(rand(), true)) . time() . microtime();
    $fileName = str_replace('.', '', $fileName);
    $fileName = str_replace(' ', '', $fileName) . $ext;
    return $fileName;
}

function formatDecimalToInteger($value)
{
    $value = str_replace(',', '.', str_replace('.', '', $value));
    return intval($value) * 100;
}
function formatIntegerToDecimal($value, $decimal = 2)
{
    $value = $value / 100;
    return number_format($value, $decimal, ',', '.');
}

function convertDateBraziltoUSA($date)
{
    $date = implode("-", array_reverse(explode("/", $date)));

    return $date;
}
function convertDateUSAtoBrazil($date, $format = "d/m/Y")
{
    $date = date($format, strtotime($date));
    return $date;
}

function generateRandomCode($size = 6)
{
    return  str_pad(rand(1, 999999), $size, "0", STR_PAD_LEFT);
}
