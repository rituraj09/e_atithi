<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Receipt;
use App\Models\Reservation;
use App\Models\RoomOnDates;
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
                            ->orderBy('id', 'DESC')
                            ->get();
        return view('guest.orders.index', compact('orders'));
    }

    public function details($id) {
        $order = Reservation::with(['guestHouse','getStatus', 'hasTransactions'])
                            ->where('reservation_no', $id)
                            ->first();
        
        $receipts = Receipt::where('reservation_id', $order->id)->select('id')->get();
        return view('guest.orders.details', compact(['order','receipts']));
    }

    public function orderCancelView($id) {
        $id = $id;
        return view('guest.orders.reservationCancel', compact('id'));
    }

    public function cancelOrder(Request $request) {
        $reservation = Reservation::find($request->reservation_id);

        $request->validate([
            'cancellationReason' => 'required',
        ],[
            'cancellationReason.required' => "Please mention the cancellation reason."
        ]);

        $isUpdate = $reservation->update([
            'status' => 2,
            'cancellation_by_guest_date' => Carbon::now('Asia/Kolkata'),
            'remarks_by_guest' => $request->cancellationReason,
        ]);

        if (!$isUpdate) {
            return back()->with(['icon' => 'failed', 'message' => 'Something is wrong.']);
        }

        return back()->with(['icon' => 'success', 'message' => 'Reservation cancelled successfully']);
    }

    public function modifyOrder ($id) {
        // return $id;
        $reservation = Reservation::find($id);
        // return $reservation;
        return view('guest.orders.modifyOrder', compact('reservation'));
    }

    // public function updateReservationDates (Request $request) {
    //     $reservation = Reservation::find($request->reservation_id);

    //     $isUpdate = $reservation->update([
    //         'check_in_date' => $request->check_in_date,
    //         'check_out_date' => $request->check_out_date,
    //     ]);

    //     $checkin = Carbon::parse($request->checkIn);
    //     $checkout = Carbon::parse($request->checkOut);

    //     $dates = $checkin->range($checkout)->toArray();

    //     // foreach ($dates as $date) {
    //     //     RoomOnDates::create([
    //     //         'room_id' => $roomId,
    //     //         'date' => $date->format('Y-m-d'),
    //     //         'reservation_id' => $reservation->id,
    //     //     ]);
    //     // }

    //     $rooms = RoomOnDates::where('reservationn_id', $request->reservation_id)->where('is_cancelled', 0)->get();

    //     foreach ($rooms as $room){
    //         if ($room->date is in $dates) {
    //             continue;
    //         } else {
    //             RoomOnDates::create([
    //                 'room_id' => $room->room_id,
    //                 'date' => $date->format('Y-m-d'),
    //                 'reservation_id' => $reservation->id,
    //             ]);
    //         }
    //     }

    //     if (!$isUpdate) {
    //         return  back()->with(['icon'=>'error', 'message'=>'Something went wrong.']);
    //     }
    //     return back()->with(['icon' => 'success', 'message' => 'Reservation details updated successfully.']);
    // }

    public function updateReservationDates(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);

        $isUpdate = $reservation->update([
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
        ]);

        $checkin = Carbon::parse($request->check_in_date);
        $checkout = Carbon::parse($request->check_out_date);

        $dates = $checkin->range($checkout)->toArray();

        // Find all room_id associated with the reservation (considering both options)
        $roomIds = [];
        $reservationRooms = $reservation->rooms; // Assuming a 'rooms' relation exists

        if ($reservationRooms !== null && count($reservationRooms) > 0) {
            // Get room_id from reservation_rooms (preferred if applicable)
            $roomIds = $reservationRooms->pluck('id')->toArray();
        } else {
            // Fallback: Get room_id from existing RoomOnDates if reservation_rooms is empty
            $existingRoomOnDates = RoomOnDates::where('reservation_id', $request->reservation_id)
                ->where('is_cancelled', 0)
                ->distinct('room_id') // Ensure unique room_id
                ->pluck('room_id');

            if ($existingRoomOnDates->count() > 0) {
                $roomIds = $existingRoomOnDates->toArray();
            } else {
                // Handle scenario where no room_id is found (consider returning an error)
                return back()->with(['icon' => 'error', 'message' => 'No room(s) associated with this reservation.']);
            }
        }

        // Update or create RoomOnDates entries for the new date range
        foreach ($roomIds as $roomId) {
            foreach ($dates as $date) {
                $formattedDate = $date->format('Y-m-d');

                if (!RoomOnDates::where('reservation_id', $request->reservation_id)
                    ->where('room_id', $roomId)
                    ->where('date', $formattedDate)
                    ->exists()) {
                    // New date for this room, create a new entry
                    RoomOnDates::create([
                        'room_id' => $roomId,
                        'date' => $formattedDate,
                        'reservation_id' => $reservation->id,
                    ]);
                }
            }
        }

        // Mark existing entries as cancelled if not in the new date range
        RoomOnDates::where('reservation_id', $request->reservation_id)
            ->whereNotIn('date', $dates)
            ->update(['is_cancelled' => 1]);

        if (!$isUpdate) {
            return back()->with(['icon' => 'error', 'message' => 'Something went wrong.']);
        }

        return back()->with(['icon' => 'success', 'message' => 'Reservation details updated successfully.']);
    }



    public function updateReservationDates_pending(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);

        $isUpdate = $reservation->update([
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
        ]);

        $checkin = Carbon::parse($request->check_in_date);
        $checkout = Carbon::parse($request->check_out_date);

        $dates = $checkin->range($checkout)->toArray();

        // existing dates
        $roomDates = RoomOnDates::where('reservation_id', $reservation->id)->pluck('date')->toArray();

        // Update or create RoomOnDates entries for the new date range
        $existingRooms = RoomOnDates::where('reservation_id', $request->reservation_id)->select('room_id')->groupBy('room_id')->get();


        // dd($roomDates, $existingRooms);

        foreach ($existingRooms as $existingRoom) {
            $roomId = $existingRoom->room_id;

            $rooms = RoomOnDates::where('reservation_id', $reservation->id)->where('room_id', $roomId)->get();


            
        }

        // foreach ($dates as $date) {
        //     $formattedDate = $date->format('Y-m-d');

        //     if ( !isset( $existingRooms[$formattedDate] ) ) {
        //         $existingRooms->update([
        //             'is_cancelled' => 1,
        //         ]);
        //     }
        // }

        // foreach ( $roomDates as $roomDate ) {

        // }

        foreach ($dates as $date) {
            $formattedDate = $date->format('Y-m-d');

            if (!isset($existingRooms[$formattedDate])) {

                RoomOnDates::create([
                    'room_id' => $existingRooms->room_id, // Assuming you have $roomId available
                    'date' => $formattedDate,
                    'reservation_id' => $reservation->id,
                ]);
            }

        }

        // Mark existing RoomOnDates as cancelled if not in the new date range
        RoomOnDates::where('reservation_id', $request->reservation_id)
            ->whereNotIn('date', $dates)
            ->update(['is_cancelled' => 1]);

        if (!$isUpdate) {
            return back()->with(['icon' => 'error', 'message' => 'Something went wrong.']);
        }

        return back()->with(['icon' => 'success', 'message' => 'Reservation details updated successfully.']);
    }

}
