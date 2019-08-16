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

// get all function Route
//Route::resource('Posts','PostController');

// get all post of function index
Route::get('Posts','PostController@index');
// get single id of function index
Route::get('Posts/{id}','PostController@index');
// get single id of function index and checked by function show about find id or not found
Route::get('Posts/{id}','PostController@show');
// creating posts
Route::post('Posts','PostController@store');
// update posts
Route::post('Posts/{id}','PostController@update');
//delete posts
Route::get('Posts/delete/{id}', 'PostController@delete');
