<?php

use App\Models\Guest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestHouseController;
use App\Http\Controllers\OfficialAuthController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Middleware\OfficialAdminMiddleware;
use App\Http\Controllers\GuestHouseAdminController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::prefix('guest-house')->group( function () {

    Route::controller(OfficialAuthController::class)->group( function () {
        Route::post('/login', 'login')->name('admin-login');
        Route::post('/registration', 'registration')->name('admin-registration');
    });

    Route::controller(GuestHouseAdminController::class)->group( function () {
        Route::get('/registration', 'registration')->name('guest-house-admin-registration');
        Route::get('/login', 'login')->name('guest-house-admin-login');
        Route::get('/profile', 'profile')->name('guest-house-admin-profile')->middleware(['auth', 'roles:admin']);
    });


    Route::get('/', function () {
        return view('guestHouse.index');
    })->name('guest-house-admin-dashboard'); //->middleware('auth');


    Route::middleware(['auth', 'roles:super admin'])->group( function () {
        Route::controller(GuestHouseController::class)->group( function () {
            Route::get('all', 'allGuestHouses')->name('all-guest-house');
            Route::get('add', 'addGuestHouses')->name('add-guest-house');
            
        }); 
    });


    // Route::middleware([OfficialAdminMiddleware::class])->group( function () {       
    Route::middleware(['auth','roles:super admin'])->prefix('/admin')->group( function () { 
        
        Route::controller(RoomController::class)->group( function () {
            Route::get('/rooms', 'roomView')->name('guest-house-admin-rooms');
            Route::get('/rooms/add-room', 'addRoomView')->name('guest-house-admin-add-room');
        });

        Route::controller(RoomCategoryController::class)->group( function () {
            Route::get('/room-category', 'roomCategories')->name('guest-house-admin-room-category');
            Route::post('/room-category/add', 'addRoomCategory')->name('guest-house-admin-add-room-category');

        });
        
        

        
        // ajax
        // Route::get('/all-room-categories', [RoomCategoryController::class, 'getAllRoomCategories'])->name('get-all-room-categories');

        
    });
});

// Route::get('/get-roles', [RoleController::class, 'getAllRoles'])->name('get-roles');

// routes for guest
// Route::controller(AuthController::class)->group(function () {
//     Route::prefix('/guest')->group( function () {

//     });
//     Route::group(['middleware' => ['auth:sanctum', 'guest']], function () {
//         Route::post('/logout', 'logout');
//     });
//     // Route::post('/student/register', 'register');
//     // Route::post('/student/login', 'login');
// });
Route::prefix('/guest')->group( function () {
    Route::get('/register', function () {
        return view('guest.registration');
    })->name('guest-registration');
    // Route::post('/register', [AuthController::class, 'registration'])->name('guest-registration');

    Route::get('/login', function () {
        return view('guest.login');
    })->name('guest-login');
    // Route::post('/login', [AuthController::class, 'login'])->name('guest-login');

    Route::middleware([GuestMiddleware::class])->group( function () {
        Route::get('/profile', [ProfileController::class, 'getProfile'])->name('guest-profile');

        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('update-guest-profile');  

        Route::get('/rooms/search', function () {
            return view('rooms.index');
        })->name('rooms');

        Route::post('/rooms/search', [GuestHouseController::class, 'getAvailableGuestHouse'])->name('guest-house-search');

        Route::get('/rooms/available', function () {
            return view('rooms.available');
        })->name('available');

        Route::get('/get-guest-houses', [GuestHouseController::class, 'getGuestHouses'])->name('get-guest-houses');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    });
});



// route for captcha
Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha');
