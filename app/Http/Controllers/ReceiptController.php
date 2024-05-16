<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Models\GuestHouseHasEmployee;

class ReceiptController extends Controller
{
    //
    public function index () {
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)
                                                ->pluck('guest_house_id')
                                                ->first();

        $receipts = Receipt::where('guest_house_id', $guest_house_id)->get();
        return view('guestHouse.Receipt.index', compact('receipts'));
    }

    public function generateReceipt ($payment) {
        
        $receipt = Receipt::create([
            'guest_house_id' => $payment->guest_house_id,
            'proceed_by' => $payment->proceed_by,
            'receipt_no' => $this->generateReceiptNO($payment->id),
            'reservation_id' => $payment->reservation_id,
            'transaction_id' => $payment->payment_no,
            'receipt_to' => $payment->guest_id,
            'receipt_date' => Carbon::now('Asia/Kolkata'),
            'amount' => $payment->amount,
        ]);

        return $receipt;
    }

    public static function generateReceiptNo($payment_id) {
        // Pad the payment ID with zeros to ensure a fixed length (e.g., 5 digits)
        $paddedPaymentId = str_pad($payment_id, 4, '0', STR_PAD_LEFT);

        // Format dates (optional, adjust format as needed)
        $formattedDate = Carbon::now('Asia/Kolkata')->format('md');

        // Generate a random string (adjust length as desired)
        $randomString = strtoupper(substr(md5(uniqid(microtime(), true)), 0, 2));

        // Combine elements with separators
        $receiptNo = "R" . $paddedPaymentId . '-' . $randomString . '-' . $formattedDate;

        return $receiptNo;
    }
}
