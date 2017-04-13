<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Morilog\Jalali\jDate;

Route::get('/', function () {
    return view('test');
});
Route::get('/posts', function () {
    return view('post');
});
Route::get('/server',function(){
	var_dump($GLOBALS);
});
Route::get('/post/{hifen}','PagesController@post')->name('post');
Route::get('/page/{hifen}','PagesController@page')->name('page');
Route::get('/notfication/{hifen}','PagesController@notfication')->name('notfication');
Route::get('/seminar/{hifen}','PagesController@seminar')->name('seminar');
Route::get('/incoming/{hifen}','PagesController@incoming')->name('incoming');
Route::get('/other/{hifen}','PagesController@other')->name('other');
Route::get('/about','PagesController@about');


Route::get('/admin-panel/',function(){
   return view('cpanel.master');
});
Route::get('/login/',function(){
   return view('auth.login');
})->name("login");

Route::post('/admin-panel/','CpanelPagesController@store');
Route::post('/admin-panel/edit','CpanelPagesController@update');
Route::get('/admin-panel/{new_post}/new/','CpanelPagesController@post');
Route::get('/admin-panel/manageposts/','CpanelPagesController@manageposts');
Route::get('/admin-panel/delete/{hifen}/','CpanelPagesController@delete_post');
Route::get('/admin-panel/edit/{hifen}/','CpanelPagesController@edit_post');

Route::get('/admin-panel/allprofessors/','CpanelPagesController@professors')->name('professors');
Route::get('/admin-panel/addprofessor/','CpanelPagesController@addprof');
Route::post('/admin-panel/addprofessor/','CpanelPagesController@storeprof');
Route::get('/admin-panel/edit/professor/{id}/','CpanelPagesController@editprof');
Route::post('/admin-panel/professor/edit','CpanelPagesController@updateprof');


Route::get('/admin-panel/navigationbar/','CpanelPagesController@navbar');
Route::post('/admin-panel/navigationbar/edit','CpanelPagesController@edit_navbar_item');
Route::post('/admin-panel/navigationbar/delete','CpanelPagesController@delete_navbar_item');
Route::post('/admin-panel/navigationbar/new','CpanelPagesController@add_navbar_item');

Route::post('/admin-panel/upload-image','Upload_Images_Controller@upload');

Route::post('comment/create/','CommentsController@store');

Route::get('/admin-panel/fastmenu/','FastMenuController@show');
Route::post('/admin-panel/fastmenu/','FastMenuController@store');
Route::post('/admin-panel/fastmenu/delete','FastMenuController@delete');

Route::get('/admin-panel/slider/','SliderController@show');
Route::get('/admin-panel/slider/delete/{hifen}','SliderController@delete');

Route::get('/admin-panel/allsetting/','SettingController@show');
Route::get('/admin-panel/allsetting/delete/{id}','SettingController@delete');
Route::post('/admin-panel/allsetting/','SettingController@addNew');
Route::post('/admin-panel/allsetting/edit/','SettingController@edit');

Route::get('/admin-panel/allcomments/','CommentsController@showAll')            ->name('allComments');
Route::get('/admin-panel/comment/{id}/show','CommentsController@show')          ->name('showComment');
Route::get('/admin-panel/allcomments/{id}/delete','CommentsController@delete')  ->name('deleteComment');
Route::get('/admin-panel/allcomments/{id}/edit','CommentsController@edit')      ->name('editComment');
Route::post('/admin-panel/allcomments/update','CommentsController@update')      ->name('updateComment');
Route::get('/admin-panel/allcomments/{id}/verify','CommentsController@verify')  ->name('verifyComment');

Route::get('/admin-panel/allusers/','UsersController@overview')                 ->name('allUsers');
Route::get('/admin-panel/add/user/','UsersController@addNew')                   ->name('addNewMember');
Route::post('/admin-panel/add/user/','UsersController@store')                   ->name('storeMember');


Route::get("/phpinfo/",function(){
   phpinfo();
});

Route::post("/getLocalTime/",function(Illuminate\Http\Request $request){
    $i=0;
    while($i++<60) {
        $date = jDate::forge();
        $now['day']=toPersianNums($date->reforge('now')->format('%d'));
        $now['weekDayName']=$date->reforge('now')->format('%A');
        $now['hour']=toPersianNums($date->reforge('now')->format('%H'));
        $now['min']=toPersianNums($date->reforge('now')->format('%M'));
        if (count(array_diff($now, $request->toArray())) > 0)
            return json_encode($now);
        sleep(1);
        unset($date);
    }
    return response()->json(['error' => 'no-change'], 500);
});

Route::get('/salam',function(){
    echo "salam";
});
//Route::get('/login',function (){
//    echo Auth::user()->name;
////    print_r(Auth::logout());
//    echo "Loged out";
//});

