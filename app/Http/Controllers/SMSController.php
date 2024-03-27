<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Hash;

class SMSController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required', // Adjust validation as per your requirements
        ]);

        $otp = rand(100000, 999999); // Generate a random 6-digit OTP
        $phone = $request->input('phone');

        $secureOtp = bcrypt($otp);

        // session
        session()->put('phone_otp', $secureOtp);
        session()->put('phone_otp_expires_at', now()->addMinutes(15));

        return response()->json(['otp'=>$otp]);

        // Send OTP via Twilio
        // $this->twilioService->sendOTP($phone, $otp);

        // Store OTP in session or database for verification

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function verifyPhoneOTP(Request $request)
    {
        $request->validate([
            'userOTP' => 'required|string|min:6|max:6', // Assuming OTP length is 6 characters
        ]);

        // Get user-entered OTP
        $userOTP = $request->input('userOTP');

        // Retrieve the stored OTP and its expiration time from the session
        $storedOTP = session('phone_otp');
        $otpExpiresAt = session('phone_otp_expires_at');

        // Check if OTP exists and is not expired
        if ($storedOTP && now()->lt($otpExpiresAt)) {
            // Verify if the user-entered OTP matches the stored OTP
            // if (password_verify($userOTP, $storedOTP)) {
            if (Hash::check($userOTP, $storedOTP)) {
                // You can clear the OTP from the session after successful verification
                session()->forget('phone_otp');
                session()->forget('phone_otp_expires_at');
                return response()->json(['message' => 'matching']);
            } else {
                // Incorrect OTP
                return response()->json(['message' => 'invalid']);
            }
        } else {
            // OTP expired or not found in session
            return response()->json(['message' => 'expired']);
        }
    }
}
