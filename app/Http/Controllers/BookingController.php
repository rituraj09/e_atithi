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

        $bookedRooms = RoomOnDates::where('date', '>=', $checkInDate)
            ->where('date', '<=', $checkOutDate)
            ->pluck('room_id');

        // Step 2: Filter out available rooms
        $rooms = Rooms::where('guest_house_id', $guestHouse->id)
            ->whereNotIn('id', $bookedRooms)
            // ->with('roomRate')
            ->get();

        // $rooms = Rooms::where('guest_house_id', $guestHouse->id)
        //             ->with('roomRate')
        //             ->get();
        $roomCategories = RoomCategory::where('guest_house_id', $guestHouse->id)->get();
        // dd($guestHouse, $rooms);
        return view('guest.booking.index', compact(['guestHouse', 'rooms', 'roomCategories', 'checkInDate', 'checkOutDate']));
    }

    public function newBooking(Request $request) {

        // return $request;
        // dd($request->toArray());
        
        $fields = $request->validate([
            'guestHouse' => 'required',
            'checkIn' => 'required',
            'checkOut' => 'required',
            'visitingReason' => 'required',
            'rooms' => 'required',
        ]);

        $guestId = auth()->guard('guest')->user()->id;
        $reservationNo = $this->generateReservationNo($request->guestHouse, $request->checkin);
        /* create reservation */
        $reservation = Reservation::create([
            'guest_id' => $guestId,
            'guest_house_id' => $request->guestHouse,
            'check_in_date' => $request->checkIn,
            'check_out_date' => $request->checkOut,
            'reservation_no' => $reservationNo,
            'reservationType' => $request->visitingReason,
            'charges_of_accomodation' => $request->totalCharge,
            'status' => 1,
            'remarks' => $request->remarks,
            'request_date' => Carbon::now('Asia/Kolkata'),
        ]);

        $rooms = explode(',', $request->rooms);

        foreach ( $rooms as $room ) {
            $roomId = (int)trim($room, '[]');
            $roomReservation = ReservationRoom::create([
                'reservation_id' => $reservationNo,
                'room_id' => $roomId,
            ]);
            
            $checkin = Carbon::parse($request->checkin);
            $checkout = Carbon::parse($request->checkout);

            $dates = $checkin->range($checkout)->toArray();

            foreach ($dates as $date) {
                RoomOnDates::create([
                    'room_id' => $roomId,
                    'date' => $date->format('Y-m-d'),
                ]);
            }
        }

        if (!$reservation || !$roomReservation) {
            dd($reservation, $roomReservation);
            // return 
        }

        return redirect()->route('guest-home')->with(['icon'=>'success', 'message'=>'Guest house booked successfully!']);
    }

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
