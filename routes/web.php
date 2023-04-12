<?php

use App\Http\Controllers\DevicesTypesController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TaxesController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    // return view('welcome');
});

// Devices Types url
Route::get('/devices_types', [DevicesTypesController::class, 'devices_types'])->name('devices_types.list');
Route::get('/devices_types/device_type/{id}', [DevicesTypesController::class, 'device_type'])->name('devices_types.one');
Route::get('/devices_types/create', [DevicesTypesController::class, 'create'])->name('devices_types.create');
Route::post('/devices_types/create', [DevicesTypesController::class, 'store'])->name('devices_types.create');
Route::get('/devices_types/update/{id}', [DevicesTypesController::class, 'update'])->name('devices_types.update');
Route::put('/devices_types/update/{id}', [DevicesTypesController::class, 'update_store'])->name('devices_types.update');
Route::delete('/devices_types/device_type/{id}', [DevicesTypesController::class, 'destroy'])->name('devices_types.delete');

// Services url
Route::get('/services', [ServicesController::class, 'services'])->name('services.list');
Route::get('/services/service/{id}', [ServicesController::class, 'service'])->name('services.one');
Route::get('/services/create', [ServicesController::class, 'create'])->name('services.create');
Route::post('/services/create', [ServicesController::class, 'store'])->name('services.create');
Route::get('/services/update/{id}', [ServicesController::class, 'update'])->name('services.update');
Route::put('/services/update/{id}', [ServicesController::class, 'update_store'])->name('services.update');
Route::delete('/services/service/{id}', [ServicesController::class, 'destroy'])->name('services.delete');

// Devices url
Route::get('/devices', [DevicesController::class, 'devices'])->name('devices.list');
Route::get('/devices/device/{number}', [DevicesController::class, 'device'])->name('devices.one');
Route::get('/devices/create', [DevicesController::class, 'create'])->name('devices.create');
Route::post('/devices/create', [DevicesController::class, 'store'])->name('devices.create');
Route::get('/devices/update/{number}', [DevicesController::class, 'update'])->name('devices.update');
Route::put('/devices/update/{number}', [DevicesController::class, 'update_store'])->name('devices.update');
Route::delete('/devices/device/{number}', [DevicesController::class, 'destroy'])->name('devices.delete');

// Taxes url
Route::get('/taxes', [TaxesController::class, 'taxes'])->name('taxes.list');
Route::get('/taxes/taxe/{id}', [TaxesController::class, 'taxe'])->name('taxes.one');
Route::get('/taxes/create', [TaxesController::class, 'create'])->name('taxes.create');
Route::post('/taxes/create', [TaxesController::class, 'store'])->name('taxes.create');
Route::get('/taxes/update/{id}', [TaxesController::class, 'update'])->name('taxes.update');
Route::put('/taxes/update/{id}', [TaxesController::class, 'update_store'])->name('taxes.update');
Route::delete('/taxes/taxe/{id}', [TaxesController::class, 'destroy'])->name('taxes.delete');
