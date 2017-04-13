<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;

class SettingController extends Controller {

	public function show()
	{
		$allQuickAccess = Setting::allQuickAccess()->get();
		$allLinks = Setting::allLinks()->get();

		return view('cpanel.pages.setting.show', compact('allQuickAccess', 'allLinks'));
	}

	public function delete($id)
	{
		Setting::findOrFail($id)->delete();

		return back();
	}

	public function edit(Request $request)
	{

		$rules = [
			'name'             => 'required|min:3',
			'value'            => 'required',
			'rel_id'           => 'integer'
		];
		$messages = [
			'name.required'    => 'عنوان را وارد نکردید.',
			'name.min'         => 'برای عنوان باید حداقل ۳ کاراکتر وارد کنید.',
			'value.required'   => 'آدرس را وارد نکردید.',
			'rel_id.integer'   => 'مشکلی تعیین نوع وجود دارد.',
		];
		$this->validate($request,$rules,$messages);
		$id = $request->rel_id;
		Setting::findOrFail($id)->update($request->all());
		return back();
	}

	public function addNew(Request $request)
	{
		$rules = [
			'name'             => 'required|min:3',
			'value'            => 'required',
			'type'             => 'integer|between:1,2'
		];
		$messages = [
			'name.required'    => 'عنوان را وارد نکردید.',
			'name.min'         => 'برای عنوان باید حداقل ۳ کاراکتر وارد کنید.',
			'value.required'   => 'آدرس را وارد نکردید.',
			'type.integer'     => 'مشکلی تعیین نوع وجود دارد.',
			'type.between'     => 'نوع انتخابی درست نیست.'
		];
		$request['set_type'] = $request->type;
		$this->validate($request,$rules,$messages);
		Setting::create($request->all());
		return back();
	}
}
