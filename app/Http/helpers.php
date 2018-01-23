<?php
use Illuminate\Support\Facades\File;
use Morilog\Jalali\jDateTime;

function toPersianNums($num)
{
	return jDateTime::convertNumbers($num);
}

function jalali(){
    return jDate::forge();
}


function seoUrl($string)
{
	//Lower case everything
//    $string = strtolower($string);
	//Make alphanumeric (removes all other characters)
//    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	//Clean up multiple dashes or whitespaces
	$string = preg_replace('/[\s-]+/', " ", $string);
	//Convert whitespaces and underscore to dash
	$string = preg_replace('/[\s_]/', "-", $string);
	return $string;
}

function HumanReadableFilesize($size, $precision = 2) {
    $units = array('بایت','کیلو‌بایت','مگابایت','گیگابایت','ترابایت','پنتابایت','اگزابایت');
    $step = 1024;
    $i = 0;
    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }
    return round($size, $precision). ' ' .$units[$i];
}
