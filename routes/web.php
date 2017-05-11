<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return config('app.name');
});


// Social Login
Route::get('login/facebook', LoginController::class . '@redirectToProvider');
Route::get('login/facebook/callback', LoginController::class . '@handleProviderCallback');

// API
Route::resource('recipes', RecipeController::class);