<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GuestHouseController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Controllers\RoomCategoryFeatureController;

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
        Route::post('/search-guest-house', 'search')->name('search-guest-house');
        Route::post('/get-guest-houses', 'getGuestHouses')->name('get-guest-houses');
        Route::get('/password-generator', 'passwordGenerator')->name('admin-password-generator');

        // Route::post('/search-locations', 'searchLocations')->name('search-locations');
    });

    Route::controller(EmailController::class)->group( function () {
        Route::post('/generateOTP', 'generateOTP')->name('email-otp');
        Route::post('/verifyOTPEmail', 'verifyOTPEmail')->name('verify-email');
        // Route::post('/resendOTP', 'gener')
    });

    Route::controller(SMSController::class)->group( function () {
        Route::post('/smsOTP', 'sendOTP')->name('sms-otp');
        Route::post('/verifyPhone', 'verifyPhoneOTP')->name('verify-phone');
    });

    Route::controller(TransactionController::class)->group( function () {
        Route::get('/fetchReservation/{rid}', 'fetchReservationById')->name('fetch-reservation-by-id');
    });

    Route::controller(ReservationController::class)->group( function () {
        Route::post('/approve-reservation', 'approveReservation')->name('approve-reservation');
        Route::post('/reject-reservation', 'rejectReservation')->name('reject-reservation');
        Route::post('/available-rooms', 'changeableRooms')->name('changeable-rooms');
        Route::get('/view-doc/{id}', 'viewFullDoc')->name('view-full-doc');
    });

    Route::controller(RoomCategoryFeatureController::class)->group( function () {
        Route::post('/room-category/add-feature', 'addRoomFeature')->name('add-new-room-feature');
        Route::post('/room-category/remove-feature', 'removeRoomFeature')->name('remove-room-feature');
    });

    Route::controller(OrderController::class)->group( function() {
        Route::get('/order/cancellation/{id}', 'orderCancelView')->name('order-cancellation');
        Route::post('/cancel-order', 'cancelOrder')->name('cancel-order');
    });

    Route::controller(PaymentController::class)->group( function() {
        Route::get('/payment/view/{id}', 'paymentModel')->name('payment-view');
    });

    // route for captcha
    Route::controller(CaptchaController::class)->group( function() {
        Route::get('/captcha', 'generateCaptcha')->name('captcha');
        Route::post('/captcha/verify', 'verifyCaptcha')->name('verify-captcha');
    });

    Route::controller(RoomController::class)->group( function () {
        Route::post('/room/update-status', 'updateStatus')->name('update-room-status');
    });

});