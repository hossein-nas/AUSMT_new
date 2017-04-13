<?php
use Illuminate\Support\Facades\File;
use Morilog\Jalali\jDateTime;

function toPersianNums($num)
{
	return jDateTime::convertNumbers($num);
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

function getFastMenuItems()
{
	if ( File::exists(public_path('fast_menu') . '/json.json') )
	{
		$json = File::get(public_path('fast_menu') . '/json.json');
		return json_decode($json, TRUE);
	} else
	{
		File::put(public_path('fast_menu') . '/json.json', '[]');
		$json = File::get(public_path('fast_menu') . '/json.json');
		return json_decode($json, TRUE);
	}
}

function addNewItemToFastMenu($p)
{
	$main_json = getFastMenuItems();
	$main_json[$p['id']] = [
		'name'  => $p['name'],
		'image' => $p['image'],
		'href'  => $p['href']
	];
	File::put(public_path('fast_menu') . '/json.json', json_encode($main_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}

function deleteFastMenuItem($p)
{
	$main_json = getFastMenuItems();
	for ( $i = $p; $i < count($main_json) - 1; $i ++ )
	{
		$main_json[$i] = [
			'name'  => $main_json[$i + 1]['name'],
			'image' => $main_json[$i + 1]['image'],
			'href'  => $main_json[$i + 1]['href']
		];
	}
	unset($main_json[$i]);
	File::put(public_path('fast_menu') . '/json.json', json_encode($main_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
