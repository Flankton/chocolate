<?php

use App\Http\Controllers\CocoaLoteController;
use App\Http\Controllers\ChocolateBarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route as RoutingRoute;
use PHPUnit\TextUI\XmlConfiguration\Group;
use PHPUnit\TextUI\XmlConfiguration\Groups;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('private/')->group(function () {
    Route::resource('cocoa_lote', CocoaLoteController::class)
    ->except(['create', 'edit']);
});
Route::prefix('public')->group(function () {
    Route::resource('chocolate_bar', ChocolateBarController::class)
    ->except(['create', 'edit']);
});
