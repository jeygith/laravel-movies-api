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

Route::get('movies/{id}', 'MoviesController@show');
Route::get('movies', 'MoviesController@index');


Route::post('register', 'Auth\RegisterController@Register');

Route::post('login', 'Auth\LoginController@login');


Route::post('logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'auth:api'], function () {

    Route::post('movies/{id}/reviews', 'MovieReviewsController@store');

    Route::post('movies', 'MoviesController@store');


    Route::patch('movies/{id}', 'MoviesController@update');

    Route::delete('movies/{id}', 'MoviesController@delete');


});





