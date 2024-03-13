<?php

namespace App\Http\Controllers;

use App\Models\Guesthouse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function index($id) {
        $guestHouse = Guesthouse::find($id)->first();
        return view('guest.booking.index');
    }

    public function newBooking(Request $request) {

        return $request;
    }

    // 'guest_id',
    //     'guest_house_id',
    //     'check_in_date',
    //     'check_out_date',
    //     'no_of_room_required',
    //     'occupency',
    //     'docs',
    //     'status',
    //     'remarks',
    //     'check_in_id',
    //     'created_at',
    //     'reservation_no',
    //     'reservation_type',
    //     'charges_of_accommodation',
    //     'remarks_by_guest',
    //     'remarks_by_admin',
    //     'approved_by',

}
