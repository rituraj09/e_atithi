<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Receipt;
use App\Models\Guesthouse;
use Illuminate\Http\Request;
use App\Models\RoomTransaction;
use App\Models\PaymentTransaction;

class PDFController extends Controller
{
    //
    public function index()
    {
        $data = [
            'title' => 'Welcome to Tutsmake.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('pdf.testPdf', $data);
    
        return $pdf->download('tutsmake.pdf');
    }

    public function printBill($id) {

        $now = Carbon::now('Asia/Kolkata');
        $bill = Bill::with(['guest', 'reservation'])->find($id);
        $guest = $bill->guest;
        $reservation = $bill->reservation;
        $hasTransactions = RoomTransaction::where('transaction_id', $bill->transaction_id)->get();

        foreach($hasTransactions as $transaction){
            $transaction->days = $now->diffInDays($transaction->checked_in_date);
            $transaction->totalCost = $transaction->days * $transaction->reservedRooms->roomDetails->total_price;
        }

        $guestHouse = Guesthouse::find($bill->guest_house_id);

        $pdf = PDF::loadView('pdf.testPdf', compact(['bill', 'guest', 'reservation', 'hasTransactions', 'guestHouse']));

        $bill_no = $bill->bill_no;
        $fileName = 'demoBill-' . $bill_no . '.pdf';

        return $pdf->download($fileName);
    }

    public function printReceipt($id = 1) {

        $now = Carbon::now('Asia/Kolkata');
        $receipt = Receipt::with(['guest', 'reservation'])->find($id);
        $guest = $receipt->guest;
        $reservation = $receipt->reservation;
        // dd($receipt->transaction_id);
        $payment_transaction = PaymentTransaction::where('payment_no', $receipt->transaction_id)->first();
        // dd($payment_transaction);
        $hasTransactions = RoomTransaction::where('transaction_id', $payment_transaction->transaction_id)->get();

        foreach($hasTransactions as $transaction){
            $transaction->days = $now->diffInDays($transaction->checked_in_date);
            $transaction->totalCost = $transaction->days * $transaction->reservedRooms->roomDetails->total_price;
        }

        $guestHouse = Guesthouse::find($receipt->guest_house_id);

        // dd($receipt->transaction_id);

        // return view('pdf.receiptPDF', compact(['receipt', 'guest', 'reservation', 'hasTransactions', 'guestHouse']));

        $pdf = PDF::loadView('pdf.receiptPDF', compact(['receipt', 'guest', 'reservation', 'hasTransactions', 'guestHouse']));

        $receipt_no = $receipt->receipt_no;
        $fileName = 'Receipt-' . $receipt_no . '.pdf';

        return $pdf->download($fileName);
    }

    public function view($billId = 1) {
        $now = Carbon::now('Asia/Kolkata');

        $bill = Bill::with(['guest', 'reservation'])->find($billId);

        $guest = $bill->guest;
        $reservation = $bill->reservation;
        $hasTransactions = RoomTransaction::where('transaction_id', $bill->transaction_id)->get();

        foreach($hasTransactions as $transaction){
            $transaction->days = $now->diffInDays($transaction->checked_in_date);
            $transaction->totalCost = $transaction->days * $transaction->reservedRooms->roomDetails->total_price;
        }

        $guestHouse = Guesthouse::find($bill->guest_house_id);

        // dd($guestHouse);

        return view('pdf.testPdf', compact(['bill', 'guest', 'reservation', 'hasTransactions', 'guestHouse']));

        // $bill_no = $bill->bill_no;

        // $fileName = 'demoBill-' . $bill_no . 'pdf';

        // return $pdf->download($fileName);
    }
}
