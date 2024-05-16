<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Guesthouse;
use Illuminate\Http\Request;
use App\Models\RoomTransaction;

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

        // dd($bill);

        $guest = $bill->guest;
        $reservation = $bill->reservation;
        $hasTransactions = RoomTransaction::where('transaction_id', $bill->transaction_id)->get();

        // dd($hasTransactions);

        foreach($hasTransactions as $transaction){
            $transaction->days = $now->diffInDays($transaction->checked_in_date);
            $transaction->totalCost = $transaction->days * $transaction->reservedRooms->roomDetails->total_price;
        }

        $guestHouse = Guesthouse::find($bill->guest_house_id);

        // dd($guestHouse);

        // return view('pdf.testPdf', compact(['bill', 'guest', 'reservation', 'hasTransactions', 'guestHouse']));

        $pdf = PDF::loadView('pdf.testPdf', compact(['bill', 'guest', 'reservation', 'hasTransactions', 'guestHouse']));

        $bill_no = $bill->bill_no;

        $fileName = 'demoBill-' . $bill_no . '.pdf';
        
        // return $pdf;

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
