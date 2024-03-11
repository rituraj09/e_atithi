<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    public function allReservations () {
        return view('guestHouse.Reservation.index');
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
