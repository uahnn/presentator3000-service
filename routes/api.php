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

Route::get('/', function () {
    return 'Hello World';
});

Auth::routes();

/*
|-----------------------
| API STARTS HERE
|-----------------------
*/

Route::resource('user', 'UserController');

// PRESENTATIONS
Route::resource('presentations', 'PresentationsController', ['only' => [
    'index', 'store', 'show', 'update', 'destroy']]);

Route::get('presentations/{id}/slides', 'SlidesController@index')->name('presentation_slides');
Route::post('presentations/{id}/slides', 'SlidesController@store')->name('add_slide_to_presentation');

// SLIDES
Route::resource('slides', 'SlidesController', ['only' => [
    'index', 'store', 'show', 'update', 'destroy']]);

// COMMENTS
Route::resource('comments', 'CommentsController', ['only' => [
    'index', 'store', 'show', 'update', 'destroy']]);

Route::get('slides/{id}/comments', 'CommentsController@index')->name('slide_comments');
Route::post('slides/{id}/comments', 'CommentsController@store')->name('add_comment_to_slide');

// CHANNELS
Route::resource('channels', 'ChannelsController', ['only' => [
    'index', 'store', 'show', 'update', 'destroy']]);

Route::get('channels/{id}/presentations', 'PresentationsController@index')->name('channel_presentations');
Route::post('channels/{cid}/presentations/{pid}', 'ChannelsController@add')->name('add_presentation_to_channel');

// TEMPLATES
Route::resource('templates', 'TemplatesController', ['only' => [
    'index', 'store', 'show', 'update', 'destroy']]);

// ATTACHEMENTS
Route::resource('attachements', 'AttachementsController', ['only' => [
    'index', 'store', 'show', 'update', 'destroy']]);

Route::get('presentations/{id}/attachements', 'AttachementsController@index')->name('presentation_attachements');
Route::post('presentations/{id}/attachements', 'AttachementsController@store')->name('add_attachement_to_presentation');