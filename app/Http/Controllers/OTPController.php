<?php

namespace App\Http\Controllers;

use Str;
// use App\Mail\OTPMail;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OTPController extends Controller
{
    //
    // public function generateOTP(Request $request)
    // {
    //     // Validate email (optional, adjust validation rules as needed)
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     $email = $request->input('email');

    //     // Generate random OTP alphan// Generates a 6-digit numeric OTPumeric
    //     // $otp = Str::random(6);

    //     // Generates a 6-digit numeric OTP
    //     $otp = rand(100000, 999999); 

    //     $secureOTP = bcrypt($otp);

    //     // Store OTP in session with a reasonable expiration time (e.g., 15 minutes)
    //     session()->put('email_otp', $secureOTP);
    //     session()->put('email_otp_expires_at', now()->addMinutes(15));

    //     // Send OTP email
    //     $this->sendOTPEmail($email, $otp);

    //     return response()->json(['message' => 'OTP sent successfully!']);
    // }

    // public function sendOTPEmail($email, $otp)
    // {
    //     $content = [
    //         "title"=>"eAtithi",
    //         "otp" => $otp,
    //         "expiry" => now()->diffInMinutes(session('otp_expires_at')),
    //     ];
        
    //     Mail::to($email)->send(new OtpMail($content));
    // }

    // public function verifyOTPEmail(Request $request)
    // {
    //     $request->validate([
    //         'userOTP' => 'required|string|min:6|max:6', // Assuming OTP length is 6 characters
    //     ]);

    //     // Get user-entered OTP
    //     $userOTP = $request->input('userOTP');

    //     // Retrieve the stored OTP and its expiration time from the session
    //     $storedOTP = session('otp');
    //     $otpExpiresAt = session('otp_expires_at');

    //     // Check if OTP exists and is not expired
    //     if ($storedOTP && now()->lt($otpExpiresAt)) {
    //         // Verify if the user-entered OTP matches the stored OTP
    //         // if (password_verify($userOTP, $storedOTP)) {
    //         if (Hash::check($userOTP, $storedOTP)) {
    //             // You can clear the OTP from the session after successful verification
    //             session()->forget('email_otp');
    //             session()->forget('email_otp_expires_at');
    //             return response()->json(['message' => 'matching']);
    //         } else {
    //             // Incorrect OTP
    //             return response()->json(['message' => 'invalid']);
    //         }
    //     } else {
    //         // OTP expired or not found in session
    //         return response()->json(['message' => 'expired']);
    //     }
    // }

}
