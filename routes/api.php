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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/', function () {
    return 'Hello World';
});

// API STARTS HERE
Route::resource('presentations', 'PresentationsController');

Route::get('presentations/{id}/slides', 'SlidesController@index');
Route::post('presentations/{id}/slides', 'SlidesController@store');

Route::resource('slides', 'SlidesController');

