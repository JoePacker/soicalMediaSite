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

Route::apiResource('comments', 'CommentController')->only([
    'update', 'destroy',
]);

Route::get('/posts/{post}/comments', 'CommentController@index');

Route::post('/posts/{post}/comments', 'CommentController@store');
