<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;

// Untuk Menu
Route::prefix('menus')->middleware('apikey')->group(function () {
    Route::get('/', [MenuController::class, 'index']);
    Route::post('/decrypt', [MenuController::class, 'decryptResponse']);
    Route::get('{id}', [MenuController::class, 'show']);
    Route::post('/', [MenuController::class, 'store']);
    Route::put('{id}', [MenuController::class, 'update']);
    Route::delete('{id}', [MenuController::class, 'destroy']);
});

// Untuk Order (dibuat sama persis strukturnya)
Route::prefix('orders')->middleware('apikey')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/decrypt', [OrderController::class, 'decryptResponse']);
    Route::get('{id}', [OrderController::class, 'show']);
    Route::post('/', [OrderController::class, 'store']);
    Route::put('{id}', [OrderController::class, 'update']);
    Route::delete('{id}', [OrderController::class, 'destroy']);
});

// Untuk Notification (dibuat sama persis strukturnya)
Route::prefix('notifications')->middleware('apikey')->group(function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::post('/decrypt', [NotificationController::class, 'decryptResponse']);
    Route::get('{id}', [NotificationController::class, 'show']);
    Route::post('/', [NotificationController::class, 'store']);
    Route::put('{id}', [NotificationController::class, 'update']);
    Route::delete('{id}', [NotificationController::class, 'destroy']);
});
