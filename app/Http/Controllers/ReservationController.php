<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
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

    public function reservationDetails () {
        return view('guestHouse.Reservation.details');
    }

    public function createReservation (Request $request) {
        return view('guestHouse.Reservation.create');
    }

    public function checkStatus(){
        return 0;
    }
}
