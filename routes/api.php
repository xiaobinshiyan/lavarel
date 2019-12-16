<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/book/bookList','BookController@bookList');
Route::get('/book/click/{id}','BookController@click');
Route::get('/book/bookinfo/{id}','BookController@bookInfo');
Route::get('/digest/digests/{id}','DigestController@Digests');
Route::get('/digest/delete/{id}','DigestController@delete');

