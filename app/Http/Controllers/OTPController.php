<?php

namespace App\Http\Controllers;

use Str;
// use App\Mail\OTPMail;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OTPController extends Controller
{
    //
    public function generateOTP(Request $request)
    {
        // Validate email (optional, adjust validation rules as needed)
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Generate random OTP
        $otp = Str::random(6);

        $secureOTP = bcrypt($otp);

        // Store OTP in session with a reasonable expiration time (e.g., 15 minutes)
        session()->put('otp', $secureOTP);
        session()->put('otp_expires_at', now()->addMinutes(15));

        // Send OTP email
        $this->sendOTPEmail($email, $otp);

        return response()->json(['message' => 'OTP sent successfully!']);
    }

    public function sendOTPEmail($email, $otp)
    {
        $content = [
            "title"=>"eAtithi",
            // "body"=>"Your One Time Password (OTP) is: ",
            "otp" => $otp,
            "expiry" => now()->diffInMinutes(session('otp_expires_at')),
        ];
        
        Mail::to($email)->send(new OtpMail($content));
    }

    public function verifyOTPEmail () {

    }
}
