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
Route::group(['prefix' => 'login/facebook'], function () {
    Route::get('/', [
        'as'   => 'login.facebook',
        'uses' => LoginController::class . '@redirectToProvider',
    ]);
    Route::get('callback', [
        'as'   => 'login.facebook.callback',
        'uses' => LoginController::class . '@handleProviderCallback',
    ]);
});

Route::post('logout', [
    'as'          => 'logout',
    'uses'        => LoginController::class . '@logout',
])
    ->middleware('auth');

// Recipes
Route::group(['prefix' => 'recipes', 'middleware' => 'auth'], function () {
    Route::get('search', [
        'as'   => 'recipes.search',
        'uses' => RecipeController::class . '@search',
    ]);

    Route::group(['prefix' => 'favourites'], function () {
        Route::get('/', [
            'as'   => 'recipes.favourites.index',
            'uses' => RecipeController::class . '@favourites',
        ]);

        Route::post('{recipe}', [
            'as'   => 'recipes.favourites.mark',
            'uses' => RecipeController::class . '@markFavourite',
        ]);

        Route::delete('{recipe}', [
            'as'   => 'recipes.favourites.unmark',
            'uses' => RecipeController::class . '@unmarkFavourite',
        ]);
    });

    Route::group(['prefix' => 'todo'], function () {
        Route::get('/', [
            'as'   => 'recipes.todo.index',
            'uses' => RecipeController::class . '@todo',
        ]);

        Route::post('{recipe}', [
            'as'   => 'recipes.todo.mark',
            'uses' => RecipeController::class . '@markTodo',
        ]);

        Route::delete('{recipe}', [
            'as'   => 'recipes.todo.unmark',
            'uses' => RecipeController::class . '@unmarkTodo',
        ]);
    });

    Route::group(['prefix' => 'done'], function () {
        Route::get('/', [
            'as'   => 'recipes.done.index',
            'uses' => RecipeController::class . '@done',
        ]);

        Route::post('{recipe}', [
            'as'   => 'recipes.done.mark',
            'uses' => RecipeController::class . '@markDone',
        ]);

        Route::delete('recipe}', [
            'as'   => 'recipes.done.unmark',
            'uses' => RecipeController::class . '@unmarkDone',
        ]);
    });
});