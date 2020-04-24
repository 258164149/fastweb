<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('sendEmail', [//客户接入数量
    'as' => 'sendEmail',
    'uses' => 'UserController@sendReminderEmail'
]);

Route::auth();

Route::get('/home', 'HomeController@index');


Route::get('/test', 'TestController@index');// 测试