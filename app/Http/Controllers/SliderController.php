<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class SliderController extends Controller {

	public function show()
	{
		$sliderItems = Post::allSliderItems()->get();

		return view('cpanel.pages.slider.slider', compact('sliderItems'));
	}

	public function delete($hifen)
	{
		$item = Post::byHifenTitle($hifen)->first();
		if ($item->count()) {
			$item->addToSlider = 0;
			$item->save();
			return back();
		}else{
			return redirect(404);
		}
	}
}
