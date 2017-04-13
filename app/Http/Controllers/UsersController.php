<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function overview(){
    	$allUsers = User::all();
	    return view('cpanel.pages.users.overviewpage',compact('allUsers'));
    }

    public function addNew(){
    	return view("cpanel.pages.users.addNew");
    }
    public function store(Request $request){
    	$rules = [
    		'username'      => [
								    'required',
								    'min:5',
								    'max:32',
								    'unique:users',
								    'regex:/^[a-z|A-Z|0-9|\._]{5,}$/'
							    ],
    		'name'          => 'required|min:5',
    		'email'         => 'required|email',
    		'post_type_id'  => 'required|digits_between:1,3',
    		'password'      => [
			                        'required',
								    'confirmed',
								    'min:8',
								    'max:32',
								    'regex:/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
		                        ],
	    ];
	    $messages = [
	    	'username.required'          => 'نام کاربری حتما باید وارد شود.',
	    	'username.min'               => 'نام کاربری حداقل باید 5 کاراکتر باشد.',
	    	'username.max'               => 'نام کاربری حداکثر باید 32 کاراکتر باشد.',
		    'username.regex'             => 'نام کاربری می تواند شامل حروف انگلیسی و اعداد و کارکتر های "_" و "." باشد.',
		    'username.unique'            => 'نام کاربری باید متمایز باشد و نمیتواند تکراری باشد.',
		    'name.min'                   => 'نام و نام خانوداگی حداقل باید 5 کاراکتر باشد.',
		    'name.required'              => 'بخش نام و نام خانوادگی حتما باید وارد شود.',
		    'email.email'                => 'ایمیلی که وارد کردید در قالب یک ایمیل استاندارد نیست.',
		    'email.required'             => 'ایمیل حتما باید وارد شود.',
		    'password.required'          => 'رمز عبور حتما باید وارد شود.',
		    'password.confirmed'         => 'رمز عبور های عبور با هم تطابقت ندارند.',
		    'password.min'               => 'رمز عبور حداقل باید 8 کاراکتر باشد.',
		    'password.max'               => 'رمز عبور حداکثر باید 32 کاراکتر باشد.',
		    'password.regex'             => 'رمز عبور حداقل باید شامل حروف لاتین (بزرگ و کوچک) و اعداد و علائم نشانه گذاری استاندارد را دارا باشد.',
		    'post_type_id.required'      => 'سطح کاربری باید مشخص شود.',
		    'post_type_id.digits_between'       => 'سطح کاربری نامشخص وارد شده است.',
	    ];
	    $request->password = Hash::make($request->password);
	    $this->validate($request,$rules,$messages);
	    User::create($request->all());
	    return back();
    }
}
