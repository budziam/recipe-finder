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
    if (auth()->check()) {
        return "Hi, " . auth()->user()->name;
    }

    return config('app.name');
});


// Social Login
Route::get('login/facebook', [
    'as'   => 'login.facebook',
    'uses' => LoginController::class . '@redirectToProvider',
]);
Route::get('login/facebook/callback', [
    'as'   => 'login.facebook.callback',
    'uses' => LoginController::class . '@handleProviderCallback',
]);

// API
Route::resource('recipes', RecipeController::class);