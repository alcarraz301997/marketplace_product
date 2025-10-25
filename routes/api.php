<?php

use App\Constant\ErrorHttp;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function (){
    Route::post('logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'products'], function () {
        Route::get('', [ProductController::class, 'index']);
        Route::get('top', [ProductController::class, 'topProducts']);
        Route::post('', [ProductController::class, 'store']);
        Route::patch('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'destroy']);
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('', [OrderController::class, 'index']);
        Route::get('by-user', [OrderController::class, 'orderByUser']);
        Route::post('', [OrderController::class, 'store']);
    });
});

Route::fallback(function () {
    return response()->json([
        'error'   => true,
        'message'   => 'No encontrado.'
    ], ErrorHttp::NOT_FOUND);
});