<?php

use App\Models\Guest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CaptchaController;
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

Route::controller(GuestHouseAdminController::class)->group( function () {
    Route::get('/registration', 'registration')->name('guest-house-admin-registration');
    Route::get('/login', 'login')->name('guest-house-admin-login');
    Route::get('/profile', 'profile')->name('guest-house-admin-profile')->middleware(['auth']);
});


Route::prefix('guest-house')->group( function () {

    // Route::get('/', function () {
    //     return view('guestHouse.index');
    // })->name('guest-house-admin-dashboard')->middleware(['auth']);

    Route::controller(OfficialAuthController::class)->group( function () {
        Route::post('/login', 'login')->name('admin-login');
        Route::post('/registration', 'registration')->name('admin-registration');
        Route::post('/logout', 'logout')->name('logout');

    });

    Route::group(['middleware' => ['auth','role:super admin']], function () {
    // Route::middleware(['auth', 'roles:super admin'])->group( function () {
        Route::controller(GuestHouseController::class)->group( function () {
            Route::get('all-guest-houses', 'allGuestHouses')->name('all-guest-house');
            Route::get('add-guest-house', 'addGuestHouse')->name('add-guest-house');
            Route::get('edit-guest-house/{id}', 'editGuestHouse')->name('edit-guest-house');
            Route::get('view-guest-house/{id}', 'viewGuestHouse')->name('view-guest-house');
            Route::post('new', 'addNewGuestHouses')->name('add-new-guest-house');           
        }); 
    });


    Route::group(['middleware' => ['auth','role:admin|super admin']], function () {       
    // Route::middleware(['auth','roles:super admin'])->prefix('/admin')->group( function () { 
        Route::controller(UsersController::class)->group( function () {
            Route::get('/users/all-users', 'allSubUsers')->name('all-sub-users');
            Route::get('/users/add-user', 'addSubUsers')->name('add-sub-users');
            Route::get('/users/edit-user/{id}', 'editSubUser')->name('edit-sub-user');
            Route::post('/users/add', 'storeSubUser')->name('new-sub-user');
        });
        
        Route::controller(RoomController::class)->group( function () {
            Route::get('/all-rooms', 'getRoom')->name('guest-house-admin-rooms');
            Route::get('/add-room', 'addRoomView')->name('guest-house-admin-add-room');
            Route::post('/new-room', 'addRoom')->name('guest-house-new-room');
            Route::get('/edit-room/{id}', 'editRoom')->name('guest-house-edit-room');
            Route::get('/room-details/{id}', 'viewRoom')->name('room-details');
        });

        Route::controller(RoomCategoryController::class)->group( function () {
            Route::get('/all-room-category', 'roomCategories')->name('room-category');
            // Route::get('/add-room-category', 'addRoomCategory')->name('add-room-category');
            Route::get('/edit-room-category/{id}', 'editRoomCategory')->name('edit-room-category');
            Route::post('/room-category/update', 'storeRoomCategory')->name('update-room-category');
            Route::post('/room-category/add', 'storeRoomCategory')->name('new-room-category');
            Route::post('/room-category/delete', 'deleteRoomCateory')->name('delete-room-category');
        });

        Route::controller(RateController::class)->group( function () {
            Route::get('/room-rates', 'allRoomRates')->name('room-rates');
            Route::get('/edit-room-rate/{id}', 'editRoomRate')->name('edit-room-rate');
            Route::get('/add-room-rate', 'addRoomRate')->name('add-room-rate');
            Route::post('/new-room-rate', 'newRoomRate')->name('new-room-rate');
        });

        Route::controller(ReservationController::class)->group( function () {
            Route::get('/reservations', 'allReservations')->name('all-reservations');
            Route::get('/reservations/approved', 'approvedReservations')->name('approved-reservations');
            Route::get('/reservations/pending', 'pendingreservations')->name('pending-reservations');
            Route::get('/reservations/rejected', 'rejectedReservations')->name('rejected-reservations');
            Route::get('/reservations/view/{id}', 'reservationDetails')->name('reservation-details');
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
    // Route::get('/register', function () {
    //     return view('guest.registration');
    // })->name('guest-registration');
    // Route::post('/register', [AuthController::class, 'registration'])->name('guest-registration');

    // Route::get('/login', function () {
    //     return view('guest.login');
    // })->name('guest-login');
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

        // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    });
});



// route for captcha
Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha');
