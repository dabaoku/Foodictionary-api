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

//User Route
Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@login');


//Ingredient Route
Route::get('ingredients', 'IngredientsController@index');

//Recipe Route
Route::post('recipe', 'RecipeController@store');
Route::get('recipe', 'RecipeController@index');
Route::get('recipe/{id}', 'RecipeController@show');
Route::get('allrecipe', 'RecipeController@allRecipe');

//Step
Route::post('step', 'StepController@store');

//Stock
Route::get('stock/{id}', 'StocksController@show');
Route::post('stock', 'StocksController@store');
Route::delete('stock/{id}', 'StocksController@destroy');

//Recipe_ingredient 應該用不到這個api
// Route::get('recipe_ingredient', 'Recipe_ingredientController@index');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
