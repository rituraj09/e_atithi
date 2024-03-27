<?php

namespace App\Http\Controllers;

use DatePeriod;
use Carbon\Carbon;
use App\Models\Rooms;
use App\Models\Guesthouse;
use App\Models\Reservation;
use App\Models\RoomOnDates;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use App\Models\ReservationRoom;

class BookingController extends Controller
{
    //
    public function index($id, $checkin, $checkout) {
        $checkInDate = $checkin;
        $checkOutDate = $checkout;
        $guestHouse = Guesthouse::where('id', $id)->first();
        $rooms = Rooms::where('guest_house_id', $guestHouse->id)
                    ->with('roomRate')
                    ->get();
        $roomCategories = RoomCategory::where('guest_house_id', $guestHouse->id)->get();
        // dd($guestHouse, $rooms);
        return view('guest.booking.index', compact(['guestHouse', 'rooms', 'roomCategories', 'checkInDate', 'checkOutDate']));
    }

    public function newBooking(Request $request) {
        // $request->query('from');
        // $request->query('to');
        // dd($request->guestHouse);

        $fields = $request->validate([
            'guestHouse' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'roomCategory' => 'required',
            'visitingReason' => 'required',
            'rooms' => 'required',
        ]);

        $guestId = auth()->guard('guest')->user()->id;
        $reservationNo = $this->generateReservationNo($request->guestHouse, $request->checkin);

        $reservation = Reservation::create([
            'guest_id' => $guestId,
            'guest_house_id' => $request->guestHouse,
            'check_in_date' => $request->checkin,
            'check_out_date' => $request->checkout,
            'reservation_no' => $reservationNo,
        ]);

        foreach ( $request->rooms as $room ) {
            $roomReservation = ReservationRoom::create([
                'reservation_id' => $reservationNo,
                'room_id' => $room,
            ]);
            
            $checkin = Carbon::parse($request->checkin);
            $checkout = Carbon::parse($request->checkout);

            $dates = $checkin->range($checkout)->toArray();

            foreach ($dates as $date) {
                RoomOnDates::create([
                    'room_id' => $room,
                    'date' => $date->format('Y-m-d'),
                ]);
            }
        }

        if (!$reservation || !$roomReservation) {
            dd($reservation, $roomReservation);
        }

        return redirect()->route('guest-home')->with(['icon'=>'success', 'message'=>'Guest house booked successfully!']);
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


    public function generateReservationNo($guestHouseId, $checkInDate)
    {
        // $date = new Date();
        // Use Carbon for date manipulation

        // Format dates (optional, adjust format as needed)
        $formattedCheckIn = Carbon::parse($checkInDate)->format('dmY');

        // Generate a random string (adjust length as desired)
        $randomString = strtoupper(substr(md5(uniqid(microtime(), true)), 0, 4));

        // Combine elements with separators
        $reservationNo = $formattedCheckIn . '-' . $guestHouseId . '-' . $randomString;

        return $reservationNo;
    }


}
