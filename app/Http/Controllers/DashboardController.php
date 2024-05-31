<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GuestHouseHasEmployee;

class DashboardController extends Controller
{
    //
    public function index() {
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)->pluck('guest_house_id')->first();
        $reservations = Reservation::where('guest_house_id', $guest_house_id)->get();
        $requestDateCounts = Reservation::where('guest_house_id', $guest_house_id)
                    ->select(DB::raw('DATE(request_date) as request_date'), DB::raw('count(*) as count'))
                    ->groupBy(DB::raw('DATE(request_date)'))
                    ->get()
                    ->toArray();
        $rooms = Rooms::where('guest_house_id', $guest_house_id)->get();
        $guestCount = Reservation::where('guest_house_id', $guest_house_id)
                        ->distinct('guest_id')
                        ->count('guest_id');

        // dd($requestDateCounts);

        return view('welcome', compact(['reservations', 'rooms', 'guestCount', 'requestDateCounts']));
    }
}
