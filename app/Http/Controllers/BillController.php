<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    public function index () {
        return view('guestHouse.Bills.index');
    }

    public function billGenerate () {

        $this->validateFields($request);

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $bill = Bill::create([
            'guest_house_id' => $guest_house_id,
            'proceed_by' => auth()->guard('web')->user()->id,
            'bill_no' => $this->bill_no($request->reservation_id),
            'reservation_id' => $request->reservation_id,
            'transaction_id' => $request->transaction_id,
            'bill_to' => $request->guest_id,
            'bill_date' => Carbon::now('Asia/Kolkata'),
            'amount' => $request->amount,
            'remarks' => '',
        ]);
    }

    public static function validateFields ($request) {
        return $request->validate([
            'reservation_id' => 'required',
            'transaction_id' => 'required',
            'bill_to' => 'required',
            'bill_date' => 'required',
            'amount' => 'required',
            'remarks' => 'required',
        ]);
    } 

    public static function bill_no ($reservationId) {
        // Format dates (optional, adjust format as needed)
        $formattedCheckIn = Carbon::now()->format('dmY');

        // padded reservation id
        $paddedReservationId = str_pad($reservationId, 5, '0', STR_PAD_LEFT);

        // Generate a random string (adjust length as desired)
        $randomString = strtoupper(substr(md5(uniqid(microtime(), true)), 0, 4));

        // Combine elements with separators
        $billNo = $reservationId . '-' . $randomString . '-' . $formattedCheckIn;

        return $billNo;
    }
}
