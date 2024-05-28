<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rooms;
use App\Models\Reservation;
use App\Models\RoomOnDates;
use Illuminate\Http\Request;
use App\Models\ReservationRoom;
use App\Models\RoomTransaction;
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

        $rooms = ReservationRoom::where('reservation_id', $reservation->reservation_no)
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

        return view('guestHouse.Reservation.details', compact('reservation', 'rooms', 'checked_in_rooms', 'checked_out_rooms'));
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

        $updatedStatus = [
            'status' => 4,   //rejected by admin
            'cancellation_by_admin_date' => Carbon::now('Asia/Kolkata'),
        ];

        $isUpdate = $reservation->update($updatedStatus);

        if (!$isUpdate) {
            return response()->json('failed');
        }
        return response()->json('success');
    }

    public function changeRoom ($id) {
        $reservation = Reservation::find($id);

        $oldRooms = ReservationRoom::where('reservation_id', $reservation->reservation_no)
            ->with('roomDetails')
            ->get();

        return view('guestHouse.Reservation.changeRoom', compact(['reservation', 'oldRooms']));
    }

    public function updateRoom (Request $request) {
        $request->validate([
            'new_room' => 'required',
        ]);

        return $request;
    }

    public function changeableRooms (Request $request) {
        $reservation = Reservation::find($request->id);

        $bookedRooms = RoomOnDates::where('date', '>=', $reservation->check_in_date)
            ->where('date', '<=', $reservation->check_out_date)
            ->pluck('room_id');

        // Step 2: Filter out available rooms
        $rooms = Rooms::where('guest_house_id', $reservation->guest_house_id)
            ->whereNotIn('id', $bookedRooms)
            ->get();

        return $rooms;
    }
}
