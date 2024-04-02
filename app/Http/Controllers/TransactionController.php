<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    public function index() {
        return view('guestHouse.Transaction.index');
    }

    public function fetchReservationById($rid){
        $reservation = Reservation::with(['getStatus'])
                                ->where('reservation_no', $rid)
                                ->first();

        $guest = Guest::find($reservation->guest_id)->get();

        return $reservation;
    }
}
