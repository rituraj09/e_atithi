<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/guest', function (Request $request) {
    return $request->user();
});


Route::post('/login', 'AuthController@login');

Route::post('/logout', 'AuthController@logout')->middleware('auth');