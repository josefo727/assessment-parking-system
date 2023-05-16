<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'confirm' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('vehicle-types', VehicleTypeController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('records', RecordController::class)->only(['index']);
});
