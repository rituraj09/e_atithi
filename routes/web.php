<?php

use App\Models\Guest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestHouseController;
use App\Http\Controllers\BedCategoryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\OfficialAuthController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Middleware\OfficialAdminMiddleware;
use App\Http\Controllers\GuestHouseAdminController;
use App\Http\Controllers\GuestHouseConfigController;
use App\Http\Controllers\RoomCategoryPriceController;
use App\Http\Controllers\RoomCategoryFeatureController;


// Route::get('/', function () {
//     return view('welcome');
// })->name('dashboard')->middleware(['auth']);
Route::redirect('/dashboard', '/');
Route::redirect('/guest-house', '/');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::controller(GuestHouseAdminController::class)->group( function () {
    Route::get('/registration', 'registration')->name('guest-house-admin-registration');
    Route::get('/login', 'login')->name('guest-house-admin-login');
    Route::get('/profile', 'profile')->name('guest-house-admin-profile')->middleware(['auth']);
    Route::post('/profile/update', 'updateProfile')->name('update-admin-profile')->middleware(['auth','role:admin|super admin']);
});

Route::prefix('guest-house')->group( function () {
    Route::controller(OfficialAuthController::class)->group( function () {
        Route::post('/login', 'login')->name('admin-login');
        Route::post('/registration', 'registration')->name('admin-registration');
        Route::post('/logout', 'logout')->name('admin-logout')->middleware(['auth']);
    });

    Route::group(['middleware' => ['auth','role:super admin']], function () {
    // Route::middleware(['auth', 'roles:super admin'])->group( function () {
        Route::controller(GuestHouseController::class)->group( function () {
            Route::get('all-guest-houses', 'allGuestHouses')->name('all-guest-house');
            Route::get('add-guest-house', 'addGuestHouse')->name('add-guest-house');
            Route::get('edit-guest-house/{id}', 'editGuestHouse')->name('edit-guest-house');
            Route::get('view-guest-house/{id}', 'viewGuestHouse')->name('view-guest-house');
            Route::post('new-guest-house', 'addNewGuestHouses')->name('add-new-guest-house');           
            Route::post('update-guest-house', 'updateGuestHouse')->name('update-guest-house');
        }); 
    });


    Route::group(['middleware' => ['auth','role:admin|super admin|approver']], function () {       
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
            Route::post('/update-room', 'updateRoom')->name('update-room');
            Route::get('/room-details/{id}', 'viewRoom')->name('room-details');
        });

        Route::controller(RoomCategoryController::class)->group( function () {
            // Route::get('/all-room-category', 'roomCategories')->name('room-category');
            // Route::get('/add-room-category', 'addRoomCategory')->name('add-room-category');
            // Route::get('/edit-room-category/{id}', 'editRoomCategory')->name('edit-room-category');
            // Route::post('/room-category/update', 'updateRoomCategory')->name('update-room-category');
            // Route::post('/room-category/add', 'storeRoomCategory')->name('new-room-category');
            // Route::post('/room-category/delete', 'deleteRoomCateory')->name('delete-room-category');
        });

        Route::controller(RateController::class)->group( function () {
            Route::get('/room-rates', 'allRoomRates')->name('room-rates');
            Route::get('/edit-room-rate/{id}', 'editRoomRate')->name('edit-room-rate');
            Route::get('/add-room-rate', 'addRoomRate')->name('add-room-rate');
            Route::post('/new-room-rate', 'newRoomRate')->name('new-room-rate');
            Route::post('/update-rate', 'updateRoomRate')->name('update-room-rate');
            Route::post('/delete-rate', 'deleteRoomRate')->name('delete-room-rate');
            Route::get('/view-room-rate/{id}', 'viewRoomRate')->name('view-room-rate');
        });

        Route::controller(FeatureController::class)->group( function () {
            Route::get('/room-features', 'allFeatures')->name('guest-house-room-features');
            Route::get('/add-features', 'addFeature')->name('add-guest-house-room-features');
            Route::get('/edit-feature/{id}', 'editFeature')->name('edit-room-feature');
            Route::post('/new-features', 'newFeatures')->name('new-room-features');
            Route::post('/update-feature', 'updateFeature')->name('update-room-feature');
        });

        Route::controller(ReservationController::class)->group( function () {
            Route::get('/reservations', 'allReservations')->name('all-reservations');
            Route::get('/reservations/approved', 'approvedReservations')->name('approved-reservations');
            Route::get('/reservations/pending', 'pendingreservations')->name('pending-reservations');
            Route::get('/reservations/rejected', 'rejectedReservations')->name('rejected-reservations');
            Route::get('/reservations/details/{id}', 'reservationDetails')->name('reservation-details');
            Route::get('/reservations/create', 'createReservation')->name('create-reservation');
            Route::get('/reservations/change-room/{id}', 'changeRoom')->name('change-reservation-room');
            Route::post('/reservations/update-room', 'updateRoom')->name('update-reservation-room');
        });

        Route::controller(TransactionController::class)->group( function () {
            Route::get('/transaction', 'index')->name('transaction');
            Route::post('/room/checkin', 'checkIn')->name('room-check-in');
            Route::post('/room/checkout', 'checkOut')->name('room-check-out');
            Route::get('/transaction/checkin/{id?}', 'checkInView')->name('check-in-view');
            Route::get('/transaction/checkout/{id?}', 'checkOutView')->name('check-out-view');
            Route::post('/get-checkin', 'getCheckIn')->name('get-check-in');
            Route::post('/get-checkout', 'getCheckOut')->name('get-check-out');
        });

        Route::controller(BedCategoryController::class)->group( function() {
            Route::get('/bed-categories', 'index')->name('bed-categories');
            Route::get('/bed-category/add', 'add')->name('add-bed-category');
            Route::get('/bed-category/view/{id}', 'view')->name('view-bed-category');
            Route::get('/bed-category/edit/{id}', 'edit')->name('edit-bed-category');
            Route::post('/bed-category/store', 'store')->name('store-bed-category');
            Route::post('/bed-category/update', 'update')->name('update-bed-category');
        });
        
        Route::controller(RoomCategoryPriceController::class)->group( function () {
            Route::get('/room-category-price','index')->name('room-category-price');
            Route::get('/room-category-price/add', 'add')->name('add-room-category-price');
            Route::get('/room-category-price/edit/{id}', 'edit')->name('edit-room-category-price');
            Route::post('/room-category/price-modifier/add', 'store')->name('new-room-category-price');
            Route::post('/room-category/price-modifier/update', 'update')->name('update-room-category-price');
        });

        Route::controller(RoomCategoryFeatureController::class)->group( function () {
            Route::get('/room-details/features/{id}', 'roomFeatures')->name('room-has-features');
        });

        Route::controller(GuestHouseConfigController::class)->group( function() {
            Route::get('/settings', 'index')->name('guest-house-config');
            Route::post('/settings/update', 'update')->name('update-guest-house-config');
        });

        Route::controller(BillController::class)->group( function() {
            Route::get('/bills', 'index')->name('all-bills');
            Route::get('/get-bill/{id}', 'printBill')->name('print-bill');
        });

        Route::controller(ReceiptController::class)->group( function() {
            Route::get('/receipts', 'index')->name('all-receipts');
            Route::get('/get-receipt/{id}', 'printReceipt')->name('print-receipt');
        });

        Route::controller(PaymentController::class)->group( function () {
            Route::post('/bill/payment', 'payBill')->name('pay-bill');
            Route::get('/payments', 'index')->name('all-payments');
        });
        
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

        // Route::get('/get-guest-houses', [GuestHouseController::class, 'getGuestHouses'])->name('get-guest-houses');

        // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    });
});





Route::get('/download-pdf', [PDFController::class, 'index']);
Route::get('/download-bill/{id}', [PDFController::class, 'printBill']);
Route::get('/view-pdf', function () {
    return view('pdf.receiptPDF');
});