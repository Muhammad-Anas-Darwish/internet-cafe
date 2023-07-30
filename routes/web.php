<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxesController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\DevicesTypesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SoldServicesController;
use App\Http\Controllers\SoldTaxesController;


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

// Route::get('/', function () {
//     $customers = new Customers;
//     $customers = $customers->getAllCustomersSortedByRemainingTime();
// });

// Devices Types url
Route::get('/devices_types', [DevicesTypesController::class, 'index'])->name('devices_types.list');
Route::get('/devices_types/device_type/{id}', [DevicesTypesController::class, 'show'])->name('devices_types.one');
Route::get('/devices_types/create', [DevicesTypesController::class, 'create'])->name('devices_types.create');
Route::post('/devices_types/create', [DevicesTypesController::class, 'store'])->name('devices_types.create');
Route::get('/devices_types/update/{id}', [DevicesTypesController::class, 'edit'])->name('devices_types.update');
Route::put('/devices_types/update/{id}', [DevicesTypesController::class, 'update'])->name('devices_types.update');
Route::delete('/devices_types/device_type/{id}', [DevicesTypesController::class, 'destroy'])->name('devices_types.delete');

// Services url
Route::get('/services', [ServicesController::class, 'index'])->name('services.list');
Route::get('/services/service/{id}', [ServicesController::class, 'show'])->name('services.one');
Route::get('/services/create', [ServicesController::class, 'create'])->name('services.create');
Route::post('/services/create', [ServicesController::class, 'store'])->name('services.create');
Route::get('/services/update/{id}', [ServicesController::class, 'edit'])->name('services.update');
Route::put('/services/update/{id}', [ServicesController::class, 'update'])->name('services.update');
Route::delete('/services/service/{id}', [ServicesController::class, 'destroy'])->name('services.delete');

// Devices url
Route::get('/devices', [DevicesController::class, 'index'])->name('devices.list');
Route::get('/devices/device/{number}', [DevicesController::class, 'show'])->name('devices.one');
Route::get('/devices/create', [DevicesController::class, 'create'])->name('devices.create');
Route::post('/devices/create', [DevicesController::class, 'store'])->name('devices.create');
Route::get('/devices/update/{number}', [DevicesController::class, 'edit'])->name('devices.update');
Route::put('/devices/update/{number}', [DevicesController::class, 'update'])->name('devices.update');
Route::delete('/devices/device/{number}', [DevicesController::class, 'destroy'])->name('devices.delete');

// Taxes url
Route::get('/taxes', [TaxesController::class, 'index'])->name('taxes.list');
Route::get('/taxes/taxe/{id}', [TaxesController::class, 'show'])->name('taxes.one');
Route::get('/taxes/create', [TaxesController::class, 'create'])->name('taxes.create');
Route::post('/taxes/create', [TaxesController::class, 'store'])->name('taxes.create');
Route::get('/taxes/update/{id}', [TaxesController::class, 'edit'])->name('taxes.update');
Route::put('/taxes/update/{id}', [TaxesController::class, 'update'])->name('taxes.update');
Route::delete('/taxes/taxe/{id}', [TaxesController::class, 'destroy'])->name('taxes.delete');

// Bookings urls
Route::get('/', [BookingsController::class, 'main'])->name('bookings.main');

// Customers urls
Route::post('/customers/create', [CustomersController::class, 'store'])->name('customers.create');
Route::put('/customers/update/{id}', [CustomersController::class, 'update'])->name('customers.update');
Route::delete('/customers/delete/{id}', [CustomersController::class, 'destroy'])->name('customers.delete');

// Sold services urls
Route::post('/sold/services/create', [SoldServicesController::class, 'store'])->name('sold.services.create');
Route::delete('/sold/services/delete/{id}', [SoldServicesController::class, 'destroy'])->name('sold.services.delete');

// Sold taxes urls
Route::post('/sold/taxes/create', [SoldTaxesController::class, 'store'])->name('sold.taxes.create');
Route::delete('/sold/taxes/delete/{id}', [SoldTaxesController::class, 'destroy'])->name('sold.taxes.delete');

// User Authentication
Route::get('/user/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/user/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::get('/user/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Create User
Route::get('/user/register', [RegisterController::class, 'create'])->name('user.create')->middleware('guest');
Route::post('/user/register', [RegisterController::class, 'store'])->name('user.create')->middleware('guest');
