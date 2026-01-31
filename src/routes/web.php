<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\HomePage;
use App\Livewire\RegistrasiPage;
use App\Livewire\LoginPage;
use App\Http\Controllers\OrderController;
use App\Livewire\OrderPage;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', HomePage::class);
Route::get('/register', RegistrasiPage::class)->name('register');
Route::post('/register', RegistrasiPage::class);
Route::get('/login', LoginPage::class)->name('login');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/order', OrderPage::class)->name('order.page');
Route::get('/order/{orderId}', OrderPage::class);
