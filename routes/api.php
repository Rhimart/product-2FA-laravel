<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product/all', [ProductsController::class, 'indexAPI']);
Route::get('product/{productId}', [ProductsController::class, 'showAPI']);
Route::post('product', [ProductsController::class, 'storeAPI']);
Route::put('product/update/{productId}', [ProductsController::class, 'editAPI']);
Route::delete('product/delete/{productId}', [ProductsController::class, 'destroyAPI']);