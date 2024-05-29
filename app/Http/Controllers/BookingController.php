<?php

namespace App\Http\Controllers;

use DatePeriod;
use Carbon\Carbon;
use App\Models\Guest;
use App\Models\Rooms;
use App\Models\Guesthouse;
use App\Models\Reservation;
use App\Models\RoomOnDates;
use App\Models\GuestDetails;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use App\Models\GuestCategories;
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
            ->get();

        $guestDetails = GuestDetails::with('guestCategory')->find(auth()->guard('guest')->user()->id);

        $roomCategories = RoomCategory::where('guest_house_id', $guestHouse->id)->get();
        // dd($guestHouse, $rooms);
        return view('guest.booking.index', compact(['guestHouse', 'rooms', 'roomCategories', 'checkInDate', 'checkOutDate', 'guestDetails']));
    }

    public function bookView($id, $checkin, $checkout) {
        $checkInDate = $checkin;
        $checkOutDate = $checkout;
        $guestHouse = Guesthouse::where('id', $id)->first();

        $guestCategories = GuestCategories::all();

        $bookedRooms = RoomOnDates::where('date', '>=', $checkInDate)
            ->where('date', '<=', $checkOutDate)
            ->pluck('room_id');

        // Step 2: Filter out available rooms
        $rooms = Rooms::where('guest_house_id', $guestHouse->id)
            ->whereNotIn('id', $bookedRooms)
            ->get();

        $guestDetails = GuestDetails::with('guestCategory')->find(auth()->guard('guest')->user()->id);

        $roomCategories = RoomCategory::where('guest_house_id', $guestHouse->id)->get();
        return view('guest.booking.book', compact(['guestHouse', 'rooms', 'roomCategories', 'checkInDate', 'checkOutDate', 'guestDetails', 'guestCategories']));
    }

    public function newBooking(Request $request) {

        $fields = $request->validate([
            'guestHouse' => 'required',
            'checkIn' => 'required',
            'checkOut' => 'required',
            'visitingReason' => 'required',
            'rooms' => 'required',
            'idFile' => 'required',
            'idFile.*' => 'mimes:jpeg,jpg,png,pdf|max:2048',
        ],[
            'visitingReason.required' => 'Please select a visiting reason.',
            'rooms.required' => 'Please select rooms',
            'idFile.required' => 'Please upload an image of required document for approvals.',
        ]);

        $guestId = auth()->guard('guest')->user()->id;
        $guest = Guest::find($guestId);
        $guestCategory = GuestDetails::select('guestcategory_id')->find($guestId);

        // dd($guestCategory);
        $idCardImageName = null;
        $idCardImageName = time() . '.' . $request->idFile->getClientOriginalExtension();
        $idCardPath = $request->idFile->storeAs('public/images', $idCardImageName);

        if ( $request->reservation_for === "others" ) {
            $extraFields = $request->validate([
                'guest_name' => 'required',
                'guest_category' => 'required',
            ],[
                'guest_name.required' => 'Please enter a guest name.',
                'guest_category.required' => 'Please select a guest category.',
            ]);
        } else {
            $extraFields['guest_name'] = $request->guest_name ? $request->guest_name : $guest->name;
            $extraFields['guest_category'] = $request->guest_category ? $request->guest_category : $guestCategory->guestcategory_id;
        }

        // dd($extraFields['guest_category']);

        $reservationNo = $this->generateReservationNo($request->guestHouse, $request->checkin);

        if ( $request->totalCharge !== 0 ) {
            /* create reservation */
            $reservation = Reservation::create([
                'guest_id' => $guestId,
                'guest_name' => $extraFields['guest_name'],
                'guest_category' => $extraFields['guest_category'],
                'guest_house_id' => $request->guestHouse,
                'check_in_date' => $request->checkIn,
                'check_out_date' => $request->checkOut,
                'reservation_no' => $reservationNo,
                'reservationType' => $request->visitingReason,
                'charges_of_accomodation' => $request->totalCharge,
                'docs' => $idCardPath,
                'status' => 1,
                'remarks' => $request->remarks,
                'request_date' => Carbon::now('Asia/Kolkata'),
            ]);
        }
        

        $rooms = explode(',', $request->rooms);

        foreach ( $rooms as $room ) {
            $roomId = (int)trim($room, '[]');
            $roomReservation = ReservationRoom::create([
                'reservation_id' => $reservationNo,
                'room_id' => $roomId,
            ]);
            
            $checkin = Carbon::parse($request->checkIn);
            $checkout = Carbon::parse($request->checkOut);

            // $dates = [];
            // for ($date = $checkin->copy(); $date->lte($checkout); $date->addDay()) {
                // $dates[] = $date->format('Y-m-d');
            // }

            $dates = $checkin->range($checkout)->toArray();

            // dd($roomReservation, $dates);

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
        // padded guestHouseId
        $paddedReservationId = str_pad($guestHouseId, 3, '0', STR_PAD_LEFT);

        // Format dates (optional, adjust format as needed)
        $formattedCheckIn = Carbon::parse($checkInDate)->format('dmY');

        // Generate a random string (adjust length as desired)
        $randomString = strtoupper(substr(md5(uniqid(microtime(), true)), 0, 4));

        // Combine elements with separators
        $reservationNo = $guestHouseId . '-' . $randomString . '-' . $formattedCheckIn;

        return $reservationNo;
    }


}
