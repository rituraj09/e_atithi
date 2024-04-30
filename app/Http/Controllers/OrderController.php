<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index() {
        $guestId = auth()->guard('guest')->user()->id;
        $orders = Reservation::with(['guestHouse','getStatus'])
                            ->where('guest_id', $guestId)
                            ->get();
        return view('guest.orders.index', compact('orders'));
    }

    public function details($id) {
        $order = Reservation::with(['guestHouse','getStatus'])
                            ->where('reservation_no', $id)
                            ->first();
        return view('guest.orders.details', compact('order'));
    }
}
