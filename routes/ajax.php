<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
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

});