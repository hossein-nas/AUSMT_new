<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Upload_Images_Controller extends Controller {

	public function upload(Request $request)
	{
		if ($request->hasFile('image')) {
			if (!in_array($request->image->extension(), ['png', 'jpeg', 'jpg','svg'])) {
				$arr = [
					'code'  => 403,
					'error' => 'شما حتما باید از تصاویر با پسوند png یا jpg یا jpeg استفاده نمایید.'
				];
				return response()->json($arr,403);
			} else {
				if (!$request->has('destPath'))
					$request->destPath = "/img/slideshow/";
				$destinationPath = public_path() . '/img/'.$request->destPath;
				$filename = str_random(10) . '.' . $request->image->extension();
				$path = $request->file('image')->move($destinationPath, $filename);
				return response('/img/'.$request->destPath . $filename, 200);
			}
		} else
			return response()->json(['error' => 'فایل به درستی آپلود نشده است.'], 500);
	}
}
