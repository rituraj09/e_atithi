<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\GuestDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index() {
        
        $guestDetail = GuestDetails::where('guest_id', auth()->guard('guest')->user()->id)->first();

        if ( !$guestDetail->nationality ) {
            return redirect()->route('edit-profile')->with(['icon'=>'warning', 'message'=>"Please update your profile first"]);
        }

        $guestId = auth()->guard('guest')->user()->id;
        $orders = Reservation::with(['guestHouse','getStatus'])
                            ->where('guest_id', $guestId)
                            ->get();
        return view('guest.orders.index', compact('orders'));
    }

    public function details($id) {
        $order = Reservation::with(['guestHouse','getStatus', 'hasTransactions'])
                            ->where('reservation_no', $id)
                            ->first();
        return view('guest.orders.details', compact('order'));
    }
}
