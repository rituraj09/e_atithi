<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Guesthouse;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function index($id) {
        $guestHouse = Guesthouse::where('id', $id)->first();
        $rooms = Rooms::where('guest_house_id', $guestHouse->id)
                    ->with('roomRate')
                    ->get();
        $roomCategories = RoomCategory::where('guest_house_id', $guestHouse->id)->get();
        // dd($guestHouse, $rooms);
        return view('guest.booking.index', compact(['guestHouse', 'rooms', 'roomCategories']));
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
