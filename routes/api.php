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

// User Route
Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@login');
Route::delete('logout','UsersController@logout');


// Ingredient Route
Route::get('ingredients', 'IngredientsController@index');

// Recipe Route
Route::post('recipe', 'RecipeController@store');
Route::get('recipe', 'RecipeController@index');
Route::get('recipe/{id}', 'RecipeController@show');
Route::get('allrecipe', 'RecipeController@allRecipe');
Route::get('allrecipeAndIngredient', 'RecipeController@getRecipeAndIngredient');

// Step
Route::post('step', 'StepController@store');

// Stock
Route::get('stock/{id}', 'StocksController@show');
Route::post('stock', 'StocksController@store');
Route::delete('stock/{id}', 'StocksController@destroy');

// Category
Route::get('category', 'CategorysController@index');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
