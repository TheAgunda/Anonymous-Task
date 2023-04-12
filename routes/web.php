<?php

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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['role:vendor']], function () {
    Route::get('/availability', [App\Http\Controllers\HomeController::class, 'availability'])->name('availability');
    Route::post('/availability/store', [App\Http\Controllers\HomeController::class, 'storeAvailability'])->name('availability.store');
    Route::get('/reschedule-off', [App\Http\Controllers\HomeController::class, 'rescheduleOff'])->name('reschedule-off');
    Route::post('/reschedule-off/store', [App\Http\Controllers\HomeController::class, 'rescheduleOffStore'])->name('reschedule-off.store');
});

Route::group(['middleware' => ['role:user']], function () {
    Route::post('/booking', [App\Http\Controllers\HomeController::class, 'booking'])->name('booking');
});
