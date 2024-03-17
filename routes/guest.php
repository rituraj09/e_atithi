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


Route::prefix('guest')->group( function () {

    Route::get('/', function () {
        return view('guest.index');
    })->name('guest-home');

    Route::controller(AuthController::class)->group( function () {
        Route::get('/registration', 'registration')->name('guest-registration');
        Route::post('/new-user', 'newRegistration')->name('new-guest-registration');
        Route::get('/login', function () {
            return view('guest.user.login');
        })->name('guest-login');
        Route::post('/login', 'login')->name('guest-login-entry');
    });

    // Route::get('/profile')

    Route::controller(ProfileController::class)->group( function () {
        Route::get('/profile', 'profile')->name('guest-profile')->middleware(['auth']);
    });

    // Route::get('/guest-houses', function () {
    //     return view('guest.rooms.index');
    // })->name('show-guest-houses');

    Route::controller(BookingController::class)->group( function () {
        Route::get('/book/{id}', 'index')->name('show-guest-house')->middleware('auth');
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
