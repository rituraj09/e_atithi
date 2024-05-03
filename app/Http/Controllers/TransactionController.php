<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReservationRoom;
use App\Models\RoomTransaction;

class TransactionController extends Controller
{
    //
    public function index() {
        $roomTransactions = RoomTransaction::with(['reservedRooms','reservationDetails'])->get();


        return view('guestHouse.Transaction.index', compact('roomTransactions'));
    }

    public function checkInView($id = null) {

        if ($id) {
            $reservation = Reservation::with(['getStatus'])
                                ->where('reservation_no', $id)
                                ->first();

            $rooms = ReservationRoom::where('reservation_id', $reservation->reservation_no)
                                ->with('roomDetails')
                                ->get();

            $reservation_no = $id;

            $guest = Guest::find($reservation->guest_id);

            return view('guestHouse.Transaction.checkin', compact(['reservation','rooms','guest', 'reservation_no']));
        } else {
            return view('guestHouse.Transaction.checkin');
        }
    }

    public function checkOutView($id = null) {
        if ($id) {
            $reservation = Reservation::with(['getStatus'])
                                ->where('reservation_no', $id)
                                ->first();

            $rooms = ReservationRoom::where('reservation_id', $reservation->reservation_no)
                                ->with('roomDetails')
                                ->get();

            $reservation_no = $id;

            $guest = Guest::find($reservation->guest_id);

            return view('guestHouse.Transaction.checkout', compact(['reservation','rooms','guest', 'reservation_no']));
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

        // dd($request);

        // $rooms = explode(',', $request->room_ids);
        $rooms = $request->room_ids;

        foreach ( $rooms as $room ) {
            // $roomId = (int)trim($room, '[]');
            $roomId = (int) $room;

            $now = Carbon::now('Asia/Kolkata');

            // $roomdetails = ReservationRoom::find($room);  we will not store the room id, instead we will fetch room id from reservedRoom collection

            // dd($room);

            $roomTransaction =  RoomTransaction::create([
                'transaction_id' => $this->generateTransactionId($roomId),
                'reservation_no' => $request->reservation_id,
                'room_id' => $roomId,
                'checked_in_date' => $now->format('dmy'),
                'checked_in_time' => $now->format('H:i:s'),
                // 'checked_out_date' => $request->checked_out_date,
                // 'checked_out_time' => $request->checked_out_time,
            ]);

        }

        if (!$roomTransaction) {
            return redirect()->route('reservation-details', ['id' => $request->reservaton_id ])->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }
        return redirect()->route('reservation-details', ['id' => $request->reservation_id ])->with(['icon'=>'success', 'message'=>'Room checked in successsfully']);

    }


    // transaction id generator
    public function generateTransactionId($roomId)
    {

        // Format dates (optional, adjust format as needed)
        $formattedDate = Carbon::now()->format('Ymd');

        // Generate a random string (adjust length as desired)
        $randomString = strtoupper(substr(md5(uniqid(microtime(), true)), 0, 2));

        // Combine elements with separators
        $transactionId = $roomId . '-' . $randomString . '-' . $formattedDate;

        return $transactionId;
    }
}
