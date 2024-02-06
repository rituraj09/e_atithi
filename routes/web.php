<?php

use App\Models\Guest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestHouseController;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('/guest')->group( function () {
    Route::get('/register', function () {
        return view('guest.registration');
    })->name('guest-registration');
    Route::post('/register', [AuthController::class, 'registration'])->name('guest-registration');

    Route::get('/login', function () {
        return view('guest.login');
    })->name('guest-login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('guest-login');

    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('guest-profile');

    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('update-guest-profile');
});

Route::get('/rooms/search', function () {
    return view('rooms.index');
})->name('rooms');

Route::post('/rooms/search', [GuestHouseController::class, 'getAvailableGuestHouse'])->name('guest-house-search');

Route::get('/rooms/available', function () {
    return view('rooms.available');
})->name('available');

Route::get('/get-guest-houses', [GuestHouseController::class, 'getGuestHouses'])->name('get-guest-houses');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha');
