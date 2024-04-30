<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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

        $checked_in_rooms = RoomTransaction::where('reservation_no', $reservation->id)
                                            ->whereNotNull('checked_in_date')
                                            ->pluck('room_id')
                                            ->toArray();
                                            // ->get();

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
            'status' => 3       //approved by admin
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
            'status' => 4   //rejected by admin
        ];

        $isUpdate = $reservation->update($updatedStatus);

        if (!$isUpdate) {
            return response()->json('failed');
        }
        return response()->json('success');
    }
}
