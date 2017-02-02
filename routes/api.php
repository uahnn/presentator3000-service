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
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
*/

Route::get('/home', 'HomeController@index');

Route::get('/', function () {
    return 'Hello World';
});

Auth::routes();

// API STARTS HERE
Route::resource('user', 'UserController');

Route::resource('presentations', 'PresentationsController');

Route::get('presentations/{id}/slides', 'SlidesController@index');
Route::post('presentations/{id}/slides', 'SlidesController@store');

Route::resource('slides', 'SlidesController');

Route::resource('comments', 'CommentsController');
Route::get('slides/{id}/comments', 'Commentscontroller@index');
Route::post('slides/{id}/comments', 'Commentscontroller@store');