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
    Route::post('/store', [App\Http\Controllers\DeliveryController::class, 'store'])->name('delivery.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\DeliveryController::class, 'destroy'])->name('delivery.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\DeliveryController::class, 'edit'])->name('delivery.edit');
    Route::put('/update/{id}', [App\Http\Controllers\DeliveryController::class, 'update'])->name('delivery.update');
    Route::get('/show/{id}', [App\Http\Controllers\DeliveryController::class, 'show'])->name('delivery.show');
    
});
Route::group(['prefix' => 'maintenance'], function () {
    Route::get('/', [App\Http\Controllers\MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::get('/create', [App\Http\Controllers\MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::post('/store', [App\Http\Controllers\MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\MaintenanceController::class, 'destroy'])->name('maintenance.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\MaintenanceController::class, 'edit'])->name('maintenance.edit');
    Route::put('/update/{id}', [App\Http\Controllers\MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::get('/show/{id}', [App\Http\Controllers\MaintenanceController::class, 'show'])->name('maintenance.show');
    
});
Route::group(['prefix' => 'physical'], function () {
    Route::get('/', [App\Http\Controllers\PhysicalController::class, 'index'])->name('physical.index');
    Route::get('/create', [App\Http\Controllers\PhysicalController::class, 'create'])->name('physical.create');
    Route::post('/store', [App\Http\Controllers\PhysicalController::class, 'store'])->name('physical.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\PhysicalController::class, 'destroy'])->name('physical.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\PhysicalController::class, 'edit'])->name('physical.edit');
    Route::put('/update/{id}', [App\Http\Controllers\PhysicalController::class, 'update'])->name('physical.update');
    Route::get('/show/{id}', [App\Http\Controllers\PhysicalController::class, 'show'])->name('physical.show');
    
});
Route::group(['prefix' => 'sparepart'], function () {
    Route::get('/', [App\Http\Controllers\SparepartController::class, 'index'])->name('sparepart.index');
    Route::get('/create', [App\Http\Controllers\SparepartController::class, 'create'])->name('sparepart.create');
    Route::post('/store', [App\Http\Controllers\SparepartController::class, 'store'])->name('sparepart.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\SparepartController::class, 'destroy'])->name('sparepart.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\SparepartController::class, 'edit'])->name('sparepart.edit');
    Route::put('/update/{id}', [App\Http\Controllers\SparepartController::class, 'update'])->name('sparepart.update');
    Route::get('/show/{id}', [App\Http\Controllers\SparepartController::class, 'show'])->name('sparepart.show');
    Route::get('/getsparepart', [App\Http\Controllers\SparepartController::class, 'getsparepart'])->name('sparepart.getsparepart');
    
});
Route::group(['prefix' => 'sparepartstok'], function () {
    Route::get('/', [App\Http\Controllers\SparepartstokController::class, 'index'])->name('sparepartstok.index');
    Route::get('/create', [App\Http\Controllers\SparepartstokController::class, 'create'])->name('sparepartstok.create');
    Route::post('/store', [App\Http\Controllers\SparepartstokController::class, 'store'])->name('sparepartstok.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\SparepartstokController::class, 'destroy'])->name('sparepartstok.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\SparepartstokController::class, 'edit'])->name('sparepartstok.edit');
    Route::put('/update/{id}', [App\Http\Controllers\SparepartstokController::class, 'update'])->name('sparepartstok.update');
    Route::get('/show/{id}', [App\Http\Controllers\SparepartstokController::class, 'show'])->name('sparepartstok.show');
    
});
Route::group(['prefix' => 'trouble'], function () {
    Route::get('/', [App\Http\Controllers\TroubleController::class, 'index'])->name('trouble.index');
    Route::get('/create', [App\Http\Controllers\TroubleController::class, 'create'])->name('trouble.create');
    Route::post('/store', [App\Http\Controllers\TroubleController::class, 'store'])->name('trouble.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\TroubleController::class, 'destroy'])->name('trouble.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\TroubleController::class, 'edit'])->name('trouble.edit');
    Route::put('/update/{id}', [App\Http\Controllers\TroubleController::class, 'update'])->name('trouble.update');
    Route::get('/show/{id}', [App\Http\Controllers\TroubleController::class, 'show'])->name('trouble.show');
    
});
Route::group(['prefix' => 'pallete'], function () {
    Route::get('/', [App\Http\Controllers\PalleteController::class, 'index'])->name('pallete.index');
    Route::get('/create', [App\Http\Controllers\PalleteController::class, 'create'])->name('pallete.create');
    Route::post('/store', [App\Http\Controllers\PalleteController::class, 'store'])->name('pallete.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\PalleteController::class, 'destroy'])->name('pallete.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\PalleteController::class, 'edit'])->name('pallete.edit');
    Route::put('/update/{id}', [App\Http\Controllers\PalleteController::class, 'update'])->name('pallete.update');
    Route::get('/show/{id}', [App\Http\Controllers\PalleteController::class, 'show'])->name('pallete.show');
    
});
Route::group(['prefix' => 'palleterenew'], function () {
    Route::get('/', [App\Http\Controllers\PalleterenewController::class, 'index'])->name('palleterenew.index');
    Route::get('/create', [App\Http\Controllers\PalleterenewController::class, 'create'])->name('palleterenew.create');
    Route::post('/store', [App\Http\Controllers\PalleterenewController::class, 'store'])->name('palleterenew.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\PalleterenewController::class, 'destroy'])->name('palleterenew.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\PalleterenewController::class, 'edit'])->name('palleterenew.edit');
    Route::put('/update/{id}', [App\Http\Controllers\PalleterenewController::class, 'update'])->name('palleterenew.update');
    Route::get('/show/{id}', [App\Http\Controllers\PalleterenewController::class, 'show'])->name('palleterenew.show');
    
});
Route::group(['prefix' => 'cbu'], function () {
    Route::get('/', [App\Http\Controllers\CbuController::class, 'index'])->name('cbu.index');
    Route::get('/create', [App\Http\Controllers\CbuController::class, 'create'])->name('cbu.create');
    Route::post('/store', [App\Http\Controllers\CbuController::class, 'store'])->name('cbu.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\CbuController::class, 'destroy'])->name('cbu.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\CbuController::class, 'edit'])->name('cbu.edit');
    Route::put('/update/{id}', [App\Http\Controllers\CbuController::class, 'update'])->name('cbu.update');
    Route::get('/show/{id}', [App\Http\Controllers\CbuController::class, 'show'])->name('cbu.show');
    
});
Route::group(['prefix' => 'region'], function () {
    Route::get('/', [App\Http\Controllers\RegionController::class, 'index'])->name('region.index');
    Route::get('/create', [App\Http\Controllers\RegionController::class, 'create'])->name('region.create');
    Route::post('/store', [App\Http\Controllers\RegionController::class, 'store'])->name('region.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\RegionController::class, 'destroy'])->name('region.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\RegionController::class, 'edit'])->name('region.edit');
    Route::put('/update/{id}', [App\Http\Controllers\RegionController::class, 'update'])->name('region.update');
    Route::get('/show/{id}', [App\Http\Controllers\RegionController::class, 'show'])->name('region.show');
    
});
Route::group(['prefix' => 'sitename'], function () {
    Route::get('/', [App\Http\Controllers\SitenameController::class, 'index'])->name('sitename.index');
    Route::get('/create', [App\Http\Controllers\SitenameController::class, 'create'])->name('sitename.create');
    Route::post('/store', [App\Http\Controllers\SitenameController::class, 'store'])->name('sitename.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\SitenameController::class, 'destroy'])->name('sitename.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\SitenameController::class, 'edit'])->name('sitename.edit');
    Route::put('/update/{id}', [App\Http\Controllers\SitenameController::class, 'update'])->name('sitename.update');
    Route::get('/show/{id}', [App\Http\Controllers\SitenameController::class, 'show'])->name('sitename.show');
    
});
Route::group(['prefix' => 'lokasi'], function () {
    Route::get('/getcbu/{id}', [App\Http\Controllers\ApiLokasi::class, 'getcbu'])->name('lokasi.getcbu');
    Route::get('/getregion/{id}', [App\Http\Controllers\ApiLokasi::class, 'getregion'])->name('lokasi.getregion');
    Route::get('/getsitename/{id}', [App\Http\Controllers\ApiLokasi::class, 'getsitename'])->name('lokasi.getsitename');
    Route::get('/setsitename/{id}', [App\Http\Controllers\ApiLokasi::class, 'setsitename'])->name('lokasi.setsitename');
});
