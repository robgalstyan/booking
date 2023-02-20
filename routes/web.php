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


Route::middleware('guest')->group(function () {
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegistrationView'])->name('register');
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginView'])->name('login');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

Route::middleware('auth')->prefix('room')->group(function () {
    Route::get('/all', [\App\Http\Controllers\RoomController::class, 'all'])->name('rooms');
    Route::get('/new', [\App\Http\Controllers\RoomController::class, 'new']);
    Route::post('/create', [\App\Http\Controllers\RoomController::class, 'save']);
    Route::get('/edit/{id}', [\App\Http\Controllers\RoomController::class, 'edit']);
    Route::post('/{id}/update', [\App\Http\Controllers\RoomController::class, 'update']);
    Route::get('/{id}/delete', [\App\Http\Controllers\RoomController::class, 'delete']);
});


Route::middleware('auth')->group(function () {
    Route::get('/booking/all', [\App\Http\Controllers\BookingController::class, 'all']);
    Route::get('/room/{id}/booking', [\App\Http\Controllers\BookingController::class, 'showBookingView']);
    Route::get('/booking/{id}/edit', [\App\Http\Controllers\BookingController::class, 'edit']);
    Route::post('/room/{id}/booking', [\App\Http\Controllers\BookingController::class, 'booking']);
    Route::post('/booking/{id}/update', [\App\Http\Controllers\BookingController::class, 'update']);
    Route::get('/booking/{id}/delete', [\App\Http\Controllers\BookingController::class, 'delete']);
});

