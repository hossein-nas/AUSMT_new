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
use Approached\LaravelImageOptimizer\ImageOptimizer;

Route::get('/', 'View\HomeController@home');
Route::get('/posts', function () {
    return view('post');
});
Route::get('/server', function () {
    var_dump($GLOBALS);
});

Route::get("/test/", function (ImageOptimizer $imageoptimizer) {
    $a = $imageoptimizer->optimizeImage('1.jpg');
    dd($a);
});

Route::post('/upload/images/', 'Files\FilesController@upload');
Route::post('/upload/record/thumbnail/', 'Files\FilesController@record_thumbnail');
Route::get('/browse/files/', 'Files\FilesController@browseFiles');

Route::get("/panel", function(){
    return view('cpanel.pages.dashboard');
})->name('cpanel');

Route::get('/temp/', function(){
    Mail::raw('Test to email', function($message){
        $message->from('notify@ausmt.ir', 'AUSMT');
        $message->to('hossein.nasiri.sovari@gmail.com');

    });
});



Route::post("/getLocalTime/", function (Illuminate\Http\Request $request) {
    $i = 0;
    while ($i++ < 60) {
        $date = jDate::forge();
        $now['day'] = toPersianNums($date->reforge('now')->format('%d'));
        $now['weekdayName'] = $date->reforge('now')->format('%A');
        $now['hour'] = toPersianNums($date->reforge('now')->format('%H'));
        $now['min'] = toPersianNums($date->reforge('now')->format('%M'));
        $now['month'] = toPersianNums($date->reforge('now')->format('%B'));
        $now['year'] = toPersianNums($date->reforge('now')->format('%y'));
        if (count(array_diff($now, $request->toArray())) > 0)
            return Response::json($now);
        sleep(1);
        unset($date);
    }

    return response()->json(['error' => 'no-change'], 500);
});

/* ...Route Group for Admin area... */
Route::group(['prefix' => 'panel'], function(){

    /* ...Routes for Records... */
    // new Record
    Route::post('records/new/{type}',"Records\RecordsController@storeRecord")->name('new_record');
    Route::get("records/new/post/news", "Records\RecordsController@showNewPost")->name('add_new_news');

    /* ...Routes for File Management pages... */
    // Files Management page
    Route::get('/files/management', "Files\FilesController@showFileManagementPage")->name('files_management');
    // Add new file page
    Route::get('/files/add/file/page', "Files\FilesController@addNewFilePage")->name('add_new_file');
    // Upload new file
    Route::post('/files/upload/file/', "Files\FilesController@uploadNewFile")->name('upload_new_file');
    // Upload new Attachment
    Route::post('/files/upload/attachment/', 'Files\FilesController@addNewAttachament')->name('upload_new_attachment');
    //add New Category method in File Category table
    Route::post('/files/new/category/file', "Files\FilesCategoryController@addNewCategory")->name("add_file_category");
    //Edit Old Category method in File Category table
    Route::post('/files/edit/category/file', "Files\FilesCategoryController@editCategory")->name("edit_file_category");
    // Delete category method in File Category table
    Route::post('/files/delete/category/file', "Files\FilesCategoryController@deleteCategory")->name("delete_file_category");

    /* ...Routes for Navigationbar Management page... */
    Route::get('/navbar/show/mangement/page', "Navigationbar@NavbarManagementPage")->name('navbar_page');
    Route::post('navbar/add/new/item', "Navigationbar@addNewItem")->name('add_new_nav_item');
    Route::post('navbar/delete/item', "Navigationbar@deleteNavItem")->name('delete_nav_item');

    /* ...Routes for Fastmenu Management page... */
    Route::get('/fastmenu/show/management/page', "Fastmenu@FastmenuManagementPage")->name('fastmenu_page');
    Route::post('/fastmenu/delete/item', "Fastmenu@deleteFastmenuItem")->name('delete_fastmenu_item');
    Route::post('/fastmenu/add/item', "Fastmenu@addFastmenuItem")->name('add_fastmenu_item');


    /* ...Routes for Comments Management in Cpanel... */
    Route::get('/comment/manage/page', "CommentsController@commentManagementPage")->name('comment_page');
    Route::post('/comment/{cm_id}/retrive', "CommentsController@getCommentById")->name('get_comment');
    Route::post('/comment/{cm_id}/verify', "CommentsController@verifyComment")->name('verify_comment');
    Route::post('/comment/{cm_id}/delete', "CommentsController@deleteComment")->name('delete_comment');
    Route::post('/comment/{cm_id}/update', "CommentsController@updateComment")->name('text/plain');
});

/* ...Route for insert comment... */
Route::post('/post/insert/comment', "CommentsController@insertNewComment")->name('insert_new_comment');


// Posts View
Route::get('/show/news/{title}/', "View\Posts\PostsController@showNews")->name('showNews');