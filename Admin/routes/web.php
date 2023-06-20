<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DeliveryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');




//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

//Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
// Route::get('delivery', [DeliveryController::class, 'index'])->name('delivery.index');

Route::group(['prefix' => 'delivery'], function () {
    Route::get('/', [App\Http\Controllers\DeliveryController::class, 'index'])->name('delivery.index');
    Route::get('/create', [App\Http\Controllers\DeliveryController::class, 'create'])->name('delivery.create');
    Route::get('/store', [App\Http\Controllers\DeliveryController::class, 'store'])->name('delivery.store');
});