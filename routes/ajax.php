<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\GuestHouseController;
use App\Http\Controllers\RoomCategoryController;

Route::prefix('/ajax')->group( function () {
    
    Route::get('/states/{cid}', [AddressController::class, 'getStates'])->name('get-states');
    Route::get('/districts/{sid}', [AddressController::class, 'getDistricts'])->name('get-districts');

    Route::controller(AddressController::class)->group( function() {

    });

    Route::controller(RoomCategoryController::class)->group( function () {
        Route::get('/all-room-categories', 'getAllRoomCategories')->name('get-all-room-categories');
        // Route::post('/delete-room-category', 'deleteRoomCategory')->name('delete-room-category');
    });

    Route::controller(UsersController::class)->group( function () {
        Route::get('/all-sub-users', 'getAllSubUsers')->name('get-all-sub-users');
    });

    Route::controller(FeatureController::class)->group( function () {
        // Route::get('/get-features')->name('get-features');
        // Route::post('/new-features', 'newFeatures')->name('new-features');
    });

    Route::controller(RateController::class)->group(function () {
        Route::post('/get-category-of-price', 'getCategoryPrice')->name('get-category-of-price');
        // Route::post('/rate-status')
    });

    Route::controller(GuestHouseController::class)->group( function() {
        Route::post('/search-guest-house', 'searchGuestHouse')->name('search-guest-house');
        Route::post('/get-guest-houses', 'getGuestHouses')->name('get-guest-houses');
    });

    Route::controller(OTPController::class)->group( function () {
        Route::post('/generateOTP', 'generateOTP')->name('email-otp');
        Route::post('/verifyOTPEmail', 'verifyOTP')->name('verify-email');
    });

});