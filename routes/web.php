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
Route::get('about',function(){
		return view('about');
});
Route::get('index','WelcomeController@index');
Route::get('/task','TaskController@home');
Route::resource('post','PostController');
Route::fallback(function(){
	return '404';
});
Route::post('form','RequestController@form');
//用于显示上传表单
Route::get('form','RequestController@formPage');
//用于处理文件上传
Route::post('form/file_upload', 'RequestController@fileUpload');