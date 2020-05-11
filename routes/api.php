<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@login');
Route::get('users', 'UsersController@index');
Route::get('users/{id}', 'UsersController@show');
Route::put('users/{id}', 'UsersController@update');
Route::delete('users/{id}', 'UsersController@destroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
