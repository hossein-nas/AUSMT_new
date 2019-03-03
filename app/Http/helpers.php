<?php

use Illuminate\Support\Facades\File;
use Morilog\Jalali\jDateTime;

function toPersianNums($num)
{
    return jDateTime::convertNumbers($num);
}

function jalali()
{
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

function HumanReadableFilesize($size, $precision = 2)
{
    $units = array('بایت', 'کیلو‌بایت', 'مگابایت', 'گیگابایت', 'ترابایت', 'پنتابایت', 'اگزابایت');
    $step = 1024;
    $i = 0;
    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }
    return round($size, $precision) . ' ' . $units[$i];
}


function is_valid_path($path)
{
    $path = public_path() . $path;
    $last_slash_post = strrpos($path, '/') + 1;
    $str_len = strlen($path);
    if ($last_slash_post == $str_len) {
        $path = substr($path, 0, $str_len - 1);
    }
    return $content = @is_dir($path)
        ? $path
        : false;
}

function is_valid_file($filepath)
{
    return $content = @file_exists($filepath)
        ? true
        : false;
}

function get_responses_json(){
    $resp_path = storage_path('app/');
    $resp_file = $resp_path."responses.json";
    if(! @file_exists($resp_file) ){
        copy($resp_file.".backup", $resp_file);
    }
    $json = file_get_contents($resp_file);
    $json = json_decode($json, true);
    $arr = collect($json);
    return ($arr['responses']);
}

function put_responses_json($arr_json){
    $resp_path = storage_path('app/');
    $resp_file = $resp_path."responses.json";
    $json = json_encode($arr_json,JSON_PRETTY_PRINT);
    $ret= file_put_contents($resp_file,$json);
    dd($ret);
    return ($arr);
}