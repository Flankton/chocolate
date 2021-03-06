<?php

use App\Http\Controllers\CocoaLoteController;
use App\Http\Controllers\ChocolateBarController;
use App\Http\Controllers\ChocolateRecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/greeting', [UserController::class, 'index']);

Route::get('/', [UserController::class, 'index']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/private')->group(function () {
    Route::resource('/cocoa_lote', CocoaLoteController::class)
    ->except(['create', 'edit']);

    Route::resource('/chocolate_recipe', ChocolateRecipeController::class)
    ->except(['create', 'edit']);
});

Route::prefix('/public')->group(function () {
    Route::resource('/chocolate_bar', ChocolateBarController::class)
    ->except(['create', 'edit']);

    Route::get('/chocolate/{public_id}', [ChocolateBarController::class, 'getChocolate']);
});
