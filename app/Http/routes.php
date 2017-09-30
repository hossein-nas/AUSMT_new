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
Route::get('/server', function () {
    var_dump($GLOBALS);
});

Route::get("/phpinfo/", function () {
    phpinfo();
});

Route::post("/getLocalTime/", function (Illuminate\Http\Request $request) {
    $i = 0;
    while ($i++ < 60) {
        $date = jDate::forge();
        $now['day'] = toPersianNums($date->reforge('now')->format('%d'));
        $now['weekDayName'] = $date->reforge('now')->format('%A');
        $now['hour'] = toPersianNums($date->reforge('now')->format('%H'));
        $now['min'] = toPersianNums($date->reforge('now')->format('%M'));
        if (count(array_diff($now, $request->toArray())) > 0)
            return json_encode($now);
        sleep(1);
        unset($date);
    }

    return response()->json(['error' => 'no-change'], 500);
});

