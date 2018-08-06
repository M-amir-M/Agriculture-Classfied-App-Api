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

Route::prefix('v1')->namespace('Api\v1')->group(function (){
    Route::get('/posts','PostsController@index');
    Route::get('/posts/{post_id}','PostsController@show');

    Route::post('/login','UsersController@login');

    Route::middleware('auth:api')->group(function(){
    	Route::get('/user','UsersController@getUser');
    	Route::post('/posts','PostsController@store');
    });
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
