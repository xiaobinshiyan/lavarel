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

// Route::get('/', function () {
//     return view('welcome');
// });
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
Route::get('form/add','RequestController@add');
Route::post('form/insert','RequestController@insert')->name('form.submit');
//用于显示上传表单
Route::get('form','RequestController@formPage');
//用于处理文件上传
Route::post('form/file_upload', 'RequestController@fileUpload');

//测试项目
Route::get('/',function(){
	return view('books.book');
});
Route::get('/book',function(){
	return view('books.book');
});
Route::get('book/create/{id?}', 'BookController@bookAdd');
Route::get('/digest/{id}','DigestController@digestList');
Route::get('/digest/edit/{id?}','DigestController@digestEdit');
Route::get('/digest/add/info','DigestController@digestEdit');
// Route::get('/book/bookList','BookController@bookList');



