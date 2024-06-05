<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rooms;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\RoomTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\GuestHouseHasEmployee;

class DashboardController extends Controller
{
    //
    public function index() {
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)->pluck('guest_house_id')->first();
        
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

        $requests = Reservation::where('guest_house_id', $guest_house_id)->whereNotNull('request_date')->select('id','request_date')->get();
        $checkIns = RoomTransaction::where('guest_house_id', $guest_house_id)->whereNotNull('checked_in_date')->select('id','checked_in_date')->get();
        $checkOuts = RoomTransaction::where('guest_house_id', $guest_house_id)->whereNotNull('checked_out_date')->select('id','checked_out_date')->get();


        // reservation card
        $reservations = Reservation::where('guest_house_id', $guest_house_id)->get();
        $reservationCounts = $this->reservationCard($reservations);

        // approval card
        $approvals = Reservation::where('guest_house_id', $guest_house_id)->whereNotNull('approval_date')->select('id','approval_date')->get();
        $approvalCounts = $this->approvalCard($approvals);

        // checkin card 
        $checkIns = RoomTransaction::where('guest_house_id', $guest_house_id)->whereNotNull('checked_in_date')->select('id','checked_in_date')->get();
        $checkInCounts = $this->checkInCard($checkIns);

        // checkout card 
        $checkOuts = RoomTransaction::where('guest_house_id', $guest_house_id)->whereNotNull('checked_out_date')->select('id','checked_out_date')->get();
        $checkOutCounts = $this->checkOutCard($checkOuts);



        return view('welcome', compact([
            'reservationCounts',
            'approvalCounts',
            'checkInCounts',
            'checkOutCounts',
            'rooms',
            'guestCount',
            'requestDateCounts',
        ]));
    }

    public function reservationCard($reservations) {
        $reservationCounts = [];

        // Iterate through reservations
        foreach ($reservations as $reservation) {
            // Get the formatted date using Carbon
            $formattedDate = Carbon::parse($reservation->request_date)->format('Y-m-d');
            
            // Increment the count for the formatted date
            if (isset($reservationCounts[$formattedDate])) {
                $reservationCounts[$formattedDate]++;
            } else {
                $reservationCounts[$formattedDate] = 1;
            }
        }

        return $reservationCounts;
    }

    public function approvalCard($approvals) {
        $approvalCounts = [];

        // Iterate through reservations
        foreach ($approvals as $approval) {
            // Get the formatted date using Carbon
            $formattedDate = Carbon::parse($approval->approval_date)->format('Y-m-d');
            
            // Increment the count for the formatted date
            if (isset($approvalCounts[$formattedDate])) {
                $approvalCounts[$formattedDate]++;
            } else {
                $approvalCounts[$formattedDate] = 1;
            }
        }
        return $approvalCounts;
    }

    public function checkInCard($checkIns) {
        $checkInCounts = [];

        // Iterate through reservations
        foreach ($checkIns as $checkIn) {
            // Get the formatted date using Carbon
            $formattedDate = Carbon::parse($checkIn->checked_in_date)->format('Y-m-d');
            
            // Increment the count for the formatted date
            if (isset($checkInCounts[$formattedDate])) {
                $checkInCounts[$formattedDate]++;
            } else {
                $checkInCounts[$formattedDate] = 1;
            }
        }
        return $checkInCounts;
    }

    public function checkOutCard($checkOuts) {
        $checkOutCounts = [];

        // Iterate through reservations
        foreach ($checkOuts as $checkOut) {
            // Get the formatted date using Carbon
            $formattedDate = Carbon::parse($checkOut->checked_out_date)->format('Y-m-d');
            
            // Increment the count for the formatted date
            if (isset($checkOutCounts[$formattedDate])) {
                $checkOutCounts[$formattedDate]++;
            } else {
                $checkOutCounts[$formattedDate] = 1;
            }
        }
        return $checkOutCounts;
    }

    public function reservedRoomCard() {

    }

    public function paymentCard() {

    }
}
