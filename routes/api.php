<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/guest', function (Request $request) {
    return $request->user();
});


Route::post('/login', 'AuthController@login');

Route::post('/logout', 'AuthController@logout')->middleware('auth');

Route::prefix('/ajax')->group( function () {
    //something like ajax =>
    // Route::get('/all-room-categories', [RoomCategoryController::class, 'getAllRoomCategories'])->name('get-all-room-categories');
    // Route::get('/states/{cid}', [AddressController::class, 'getStates'])->name('get-states');

});