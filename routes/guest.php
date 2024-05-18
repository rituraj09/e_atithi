<?php

use App\Models\Guest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestHouseController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\OfficialAuthController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Middleware\OfficialAdminMiddleware;
use App\Http\Controllers\GuestHouseAdminController;

// ajax routes
// require __DIR__.'/ajax.php';

Route::get('/', function () {
    return view('welcome');
})->name('dashboard')->middleware(['auth']);
Route::redirect('/dashboard', '/');
Route::redirect('/guest-house', '/');
Route::redirect('/guest', '/guest/home');


Route::prefix('guest')->group( function () {

    Route::get('/home', function () {
        return view('guest.index');
    })->name('guest-home');

    Route::controller(AuthController::class)->group( function () {
        Route::get('/registration', 'registration')->name('guest-registration');
        Route::post('/new-user', 'newRegistration')->name('new-guest-registration');
        Route::get('/login', function () {
            return view('guest.user.login');
        })->name('guest-login');
        Route::post('/login', 'login')->name('guest-login-entry');
        Route::post('/logout', 'logout')->name('guest-logout');
    });

    // Route::get('/profile')
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('my-orders')->middleware('guest');
        Route::get('/orders/details/{id}', 'details')->name('order-details')->middleware('guest');
        Route::get('/orders/modify/{id}', 'modifyOrder')->name('modify-order')->middleware('guest');
        Route::post('/orders/update', 'updateReservationDates')->name('update-reservation')->middleware('guest');
    });

    Route::controller(ProfileController::class)->group( function () {
        Route::get('/profile', 'getProfile')->name('guest-profile')->middleware('guest');
        Route::get('/profile/edit', 'editProfile')->name('edit-profile')->middleware('guest');
        Route::get('/profile/edit-password', 'editPassword')->name('edit-password')->middleware('guest');
        Route::post('/profile/update-password', 'updatePassword')->name('update-password')->middleware('guest');
        Route::post('/profile/store', 'updateProfile')->name('store-profile')->middleware('guest');
    });

    Route::controller(BookingController::class)->group( function () {
        Route::get('/book/{id}/{checkin}/{checkout}', 'index')->name('show-guest-house')->middleware('guest');
        Route::post('/book/new', 'newBooking')->name('new-booking')->middleware('guest');
    });

    Route::group(['middleware' => ['auth','role:admin|super admin']], function () {       
    // Route::middleware(['auth','roles:super admin'])->prefix('/admin')->group( function () { 
        // Route::controller(UsersController::class)->group( function () {
        //     Route::get('/users/all-users', 'allSubUsers')->name('all-sub-users');
        //     Route::get('/users/add-user', 'addSubUsers')->name('add-sub-users');
        //     Route::get('/users/edit-user/{id}', 'editSubUser')->name('edit-sub-user');
        //     Route::post('/users/add', 'storeSubUser')->name('new-sub-user');
        // });

    });
});
