<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReservationRoom;
use App\Models\RoomTransaction;
use App\Models\GuestHouseHasEmployee;

class TransactionController extends Controller
{
    //
    public function index() {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $roomTransactions = RoomTransaction::with(['reservedRooms','reservationDetails'])
                                            // ->where('reservationDetails.guest_house_id',$guest_house_id)
                                            ->get();


        return view('guestHouse.Transaction.index', compact('roomTransactions'));
    }

    public function getCheckIn(Request $request) {
        return redirect()->route('check-in-view', ['id' => $request->reservation_no]);
    }

    public function getCheckOut(Request $request) {
        return redirect()->route('check-out-view', ['id' => $request->reservation_no]);
    }

    public function checkInView($id = null) {

        if ($id) {
            $reservation = Reservation::with(['getStatus'])
                                ->where('reservation_no', $id)
                                ->first();

            $rooms = ReservationRoom::where('reservation_id', $reservation->reservation_no)
                                ->with('roomDetails')
                                ->get();

            $checked_in_rooms = RoomTransaction::where('reservation_no', $reservation->id)
                                ->whereNotNull('checked_in_date')
                                ->pluck('room_id')
                                ->toArray();

            $reservation_no = $id;

            $guest = Guest::find($reservation->guest_id);

            return view('guestHouse.Transaction.checkin', compact(['reservation','rooms','guest', 'reservation_no', 'checked_in_rooms']));
        } else {
            return view('guestHouse.Transaction.checkin');
        }
    }

    public function checkOutView($id = null) {
        $now = Carbon::now('Asia/Kolkata');

        if ($id) {
            $reservation = Reservation::with(['getStatus'])
                                ->where('reservation_no', $id)
                                ->first();

            $checked_in_rooms = RoomTransaction::where('reservation_no', $reservation->id)
                                            ->whereNotNull('checked_in_date')
                                            ->with(['reservedRooms', 'reservationDetails'])
                                            ->get();

            $checked_out_rooms = RoomTransaction::where('reservation_no', $reservation->id)
                                            ->whereNotNull('checked_out_date')
                                            ->pluck('room_id')
                                            ->toArray();

            $reservation_no = $id;

            $guest = Guest::find($reservation->guest_id);

            foreach($checked_in_rooms as $room){
                $room->days = $now->diffInDays($room->checked_in_date);
                $room->totalCost = $room->days * $room->reservedRooms->roomDetails->total_price;
            }

            return view('guestHouse.Transaction.checkout', compact(['reservation','guest', 'reservation_no', 'checked_in_rooms', 'checked_out_rooms']));
        } else {
            return view('guestHouse.Transaction.checkout');
        }
    }

    public function fetchRooms() {

    }

    public function fetchReservationById($rid){
        $reservation = Reservation::with(['getStatus'])
                                ->where('reservation_no', $rid)
                                ->first();

        $guest = Guest::find($reservation->guest_id)->get();

        return $reservation;
    }

    public function checkIn(Request $request) {

        // $request->validate([
        //     'room_ids[]' => 'required',
        //     'reservation_id' => 'required',
        // ]);


        // $rooms = explode(',', $request->room_ids);
        $rooms = $request->room_ids;

        $transactionId = $this->generateTransactionId($request->reservation_id);

        foreach ( $rooms as $room ) {
            // $roomId = (int)trim($room, '[]');
            $roomId = (int) $room;

            $now = Carbon::now('Asia/Kolkata');

            // $roomdetails = ReservationRoom::find($room);  we will not store the room id, instead we will fetch room id from reservedRoom collection

            $roomTransaction =  RoomTransaction::create([
                'transaction_id' => $transactionId,
                'reservation_no' => $request->reservation_id,
                'room_id' => $roomId,
                'checked_in_date' => $now->format('y-m-d'),
                'checked_in_time' => $now->format('H:i:s'),
            ]);

        }

        if (!$roomTransaction) {
            return redirect()->route('reservation-details', ['id' => $request->reservaton_id ])->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }
        return back()->with(['icon'=>'success', 'message'=>'Room checked in successsfully']);

    }

    public function checkOut(Request $request) {

        // dd($request);

        // $rooms = explode(',', $request->room_ids);
        $rooms = $request->room_ids;

        foreach ( $rooms as $room ) {
            // $roomId = (int)trim($room, '[]');
            $roomId = (int) $room;

            $now = Carbon::now('Asia/Kolkata');

            // $roomdetails = ReservationRoom::find($room);  we will not store the room id, instead we will fetch room id from reservedRoom collection

            $roomTransaction = RoomTransaction::find($roomId);

            // dd($roomTransaction);

            $roomTransaction->update([
                'checked_out_date' => $now->format('y-m-d'),
                'checked_out_time' => $now->format('H:i:s'),
                // 'checked_out_date' => $request->checked_out_date,
                // 'checked_out_time' => $request->checked_out_time,
            ]);

        }

        if (!$roomTransaction) {
            return back()->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }
        return back()->with(['icon'=>'success', 'message'=>'Room checked out successsfully']);

    }


    // transaction id generator
    public function generateTransactionId($reservationId)
    {
        // Pad the reservation ID with zeros to ensure a fixed length (e.g., 5 digits)
        $paddedReservationId = str_pad($reservationId, 5, '0', STR_PAD_LEFT);

        // Format dates (optional, adjust format as needed)
        $formattedDate = Carbon::now('Asia/Kolkata')->format('md');

        // Generate a random string (adjust length as desired)
        $randomString = strtoupper(substr(md5(uniqid(microtime(), true)), 0, 2));

        // Combine elements with separators
        $transactionId = $paddedReservationId . '-' . $randomString . '-' . $formattedDate;

        return $transactionId;
    }
}
