<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use Illuminate\Http\Request;
use App\Models\RoomTransaction;
use App\Models\PaymentTransaction;
use App\Models\GuestHouseHasEmployee;
use App\Http\Controllers\ReceiptController;

class PaymentController extends Controller
{
    //
    public function index() {
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id )
                                                ->pluck('guest_house_id')
                                                ->first();

        $payments = PaymentTransaction::where('guest_house_id', $guest_house_id)->get();

        return view('guestHouse.Payments.index', compact('payments'));
    }

    public function paymentModel($id) {
        $now = Carbon::now('Asia/Kolkata');

        $bill = Bill::with(['guest','reservation'])->find($id);

        $hasTransactions = RoomTransaction::where('transaction_id', $bill->transaction_id)->get();

        foreach($hasTransactions as $transaction){
            $transaction->days = $now->diffInDays($transaction->checked_in_date);
            $transaction->totalCost = $transaction->days * $transaction->reservedRooms->roomDetails->total_price;
        }
        
        return view('guest.payment.index', compact(['bill','hasTransactions']));
    }

    public function payBill (Request $request) {

        $isPaid = PaymentTransaction::create([
            'payment_no' => $this->generatePaymentNo($request->bill_id),
            'bill_id' => $request->bill_id,
            'transaction_id' => $request->transaction_id,
            'reservation_id' => $request->reservation_id,
            'proceed_by' => auth()->guard('web')->user()->id,
            'guest_id' => $request->guest_id,
            'guest_house_id' => $request->guest_house_id,
            'total_amount' => $request->amount,
            // 'remarks' => $request->,
        ]);

        if ( !$isPaid ) {
            return back()->with(['icon' => 'error', 'message' => 'Payment failed.']);
        }

        $receiptController = new ReceiptController();
        $generateReceipt = $receiptController->generateReceipt($isPaid);


        if (!$generateReceipt) {
            return back()->with(['icon' => 'error', 'message' => 'Receipt generation failed.']);
        }

        return back()->with(['icon' => 'success', 'message' => 'Payment successfull with a receipt.']);
    }

    public static function generatePaymentNo($bill_id) {

        $paddedBillId = str_pad($bill_id, 4, '0', STR_PAD_LEFT);

        // Format dates (optional, adjust format as needed)
        $formattedDate = Carbon::now('Asia/Kolkata')->format('Ymd');

        // Generate a random string (adjust length as desired)
        $randomString = strtoupper(substr(md5(uniqid(microtime(), true)), 0, 2));

        // Combine elements with separators
        $generatedNo = $paddedBillId . '-' . $randomString . '-' . $formattedDate;

        return $generatedNo;
    }

    public static function validateFields($request) {
        return $request->validate([
            'bill_id' => 'required',
            'transaction_id' => 'required',
            'reservation_id' => 'required',
            'guest_id' => 'required',
            'total_amount' => 'required',
        ], [
            'bill_id.required' => '',
            'transaction_id.required' => '',
            'reservation_id.required' => '',
            'guest_id.required' => '',
            'total_amount.required' => '',
        ]);
    }
}
