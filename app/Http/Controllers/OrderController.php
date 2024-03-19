<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index() {
        $guestId = auth()->guard('guest')->user()->id;
        $orders = Reservation::with('guestHouse')
                            ->where('guest_id', $guestId)
                            ->get();
        return view('guest.orders.index', compact('orders'));
    }
}
