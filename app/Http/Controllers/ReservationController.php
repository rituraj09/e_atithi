<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rooms;
use App\Models\Reservation;
use App\Models\RoomOnDates;
use Illuminate\Http\Request;
use App\Models\ReservationRoom;
use App\Models\RoomTransaction;
use App\Models\PaymentTransaction;
use App\Models\GuestHouseHasEmployee;

class ReservationController extends Controller
{
    //
    public function allReservations () {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        
        $reservations = Reservation::where('guest_house_id', $guest_house_id)
                                    ->with('guest')
                                    ->get();

        return view('guestHouse.Reservation.index', compact('reservations'));
    }

    public function getAllReservations () {
        return response()->json($data, 200, $headers);
    }

    public function approvedReservations () {
        return view('guestHouse.Reservation.approved');
    }
    
    public function pendingReservations () {
        return view('guestHouse.Reservation.pending');
    }

    public function rejectedReservations () {
        return view('guestHouse.Reservation.rejected');
    }

    public function reservationDetails($id)
    {
        $reservation = Reservation::with(['guest', 'getStatus'])
                                    ->where('id', $id)
                                    ->first();

        $rooms = ReservationRoom::where('reservation_id', $reservation->id)
                                ->with('roomDetails')
                                ->get();

        // it returns all the checked in rooms
        $checked_in_rooms = RoomTransaction::where('reservation_no', $reservation->id)
                                            ->whereNotNull('checked_in_date')
                                            ->pluck('room_id')
                                            ->toArray();
                                            // ->get();

        // it returns all the checked out rooms
        $checked_out_rooms = RoomTransaction::where('reservation_no', $reservation->id)
                                            ->whereNotNull('checked_out_date')
                                            ->pluck('room_id')
                                            ->toArray();

        $payment = PaymentTransaction::where('reservation_id', $id)->sum('total_amount');

        return view('guestHouse.Reservation.details', compact('reservation', 'rooms', 'checked_in_rooms', 'checked_out_rooms', 'payment'));
    }



    public function createReservation (Request $request) {
        return view('guestHouse.Reservation.create');
    }

    public function checkStatus(){
        return 0;
    }

    public function approveReservation (Request $request) {
        $reservation = Reservation::find($request->id);

        $updatedStatus = [
            'status' => 3,       //approved by admin
            'approval_date' => Carbon::now('Asia/Kolkata'),
        ];

        $isUpdate = $reservation->update($updatedStatus);

        if (!$isUpdate) {
            return response()->json('failed');
        }
        return response()->json('success');

    }

    public function rejectReservation (Request $request) {
        $reservation = Reservation::find($request->id);

        // $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guear('web')->user()->id)->pluck('guest_house_id')->first();

        $updatedStatus = [
            'status' => 4,   //rejected by admin
            'cancellation_by_admin_date' => Carbon::now('Asia/Kolkata'),
        ];

        $isUpdate = $reservation->update($updatedStatus);

        if (!$isUpdate) {
            return response()->json('failed');
        }

        // $oldRooms = ReservationRoom::where('reservation_id', $reservation->id)->get();

        $roomOnDates = RoomOnDates::where('reservation_id', $reservation->id)->get();

        foreach ($roomOnDates as $roomOnDate ) {
            $roomOnDate->update([
                'is_cancelled' => 1,
            ]);
        }

        return response()->json('success');
    }

    public function changeRoom ($id) {
        $reservation = Reservation::find($id);

        $oldRooms = ReservationRoom::where('reservation_id', $reservation->id)
            ->with('roomDetails')
            ->get();

        $bookedRooms = RoomOnDates::where('date', '>=', $reservation->check_in_date)
            ->where('date', '<=', $reservation->check_out_date)
            ->where('is_cancelled', 0)
            ->pluck('room_id');

        // Step 2: Filter out available rooms
        $rooms = Rooms::where('guest_house_id', $reservation->guest_house_id)
            ->whereNotIn('id', $bookedRooms)
            ->get();

        return view('guestHouse.Reservation.changeRoom', compact(['reservation', 'oldRooms', 'rooms']));
    }

    public function updateRoom (Request $request) {

        $reservation = Reservation::find($request->reservation_id);

        $num_rooms = $request->num_rooms;
        $reservations = ReservationRoom::where('reservation_id', $reservation->id)
                                        ->with('roomDetails')
                                        ->get();

        // return $reservations;

        foreach ( $reservations as $reservation ) {
            $room = $request->input('new_room_' . $reservation->roomDetails->room_number);
            if ($room) {
                $reservation->update([
                    'room_id' => $room,
                ]);
            }
            $roomDates = RoomOnDates::where('room_id', $room)
                                    ->where('reservation_id', $request->reservation_id)
                                    ->get();
            foreach ( $roomDates as $roomDate ) {
                $roomDate->update([
                    'is_cancelled' => 1,
                ]);
            }
            // dd($room);
        }

        return $request;
    }

    public function changeableRooms (Request $request) {
        $reservation = Reservation::find($request->id);

        $bookedRooms = RoomOnDates::where('date', '>=', $reservation->check_in_date)
            ->where('date', '<=', $reservation->check_out_date)
            ->where('is_cancelled', 0)
            ->pluck('room_id');

        // Step 2: Filter out available rooms
        $rooms = Rooms::where('guest_house_id', $reservation->guest_house_id)
            ->whereNotIn('id', $bookedRooms)
            ->get();

        return $rooms;
    }

    public function viewFullDoc($id) {
        $image = Reservation::select('docs')->find($id);

        return view('guestHouse.Reservation.viewDoc', compact('image'));
    }
}
