<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\GuestHouseHasEmployee;
use App\Http\Controllers\PDFController;

class BillController extends Controller
{
    //
    public function index () {
        $employeeId = auth()->guard('web')->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $bills = Bill::with(['guest','reservation'])
                    ->where('guest_house_id', $guest_house_id)
                    ->get();
        
        $payments = PaymentTransaction::where('guest_house_id', $guest_house_id)->pluck('bill_id')->toArray();

        return view('guestHouse.Bills.index', compact(['bills','payments']));
    }

    public function billGenerate ($request) {

        $this->validateFields($request);

        $employeeId = auth()->guard('web')->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $bill = Bill::create([
            'guest_house_id' => $guest_house_id,
            'proceed_by' => $employeeId,
            'bill_no' => $this->bill_no($request->reservation_id),
            'reservation_id' => $request->reservation_id,
            'transaction_id' => $request->transaction_id,
            'bill_to' => $request->guest_id,
            'bill_date' => Carbon::now('Asia/Kolkata'),
            'amount' => $request->amount,
            'remarks' => '',
        ]);

        return $bill;
    }

    public function printBill ($id) {
        $printController = new PDFController();
        return $printController->printBill($id);
    }

    public static function validateFields ($request) {
        return $request->validate([
            'reservation_id' => 'required',
            'transaction_id' => 'required',
            'guest_id' => 'required',
            'amount' => 'required',
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
