<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\GuestsLogs;
use App\Models\GuestDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registration () {
        return view('guest.user.registration');
    }

    public function newRegistration (Request $request) {
        $request->validate([
            'fullname' => 'required|min:3',
            'phone' => 'required|digits:10',
            'email' => 'required|email|unique:guest,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required_with:password|same:password|min:6',
        ],[
            'fullname.required' => 'Name is required',
            'fullname.min' => 'Name should atleast contain 3 characters',
            'phone.required' => 'Phone number is required',
            'phone.digits' => 'Phone number should contain 10 digits',
            'email.required' => 'Email address is required',
            'email.unique' => 'Email address already exist',
            'role.required' => 'Please select a role for the user/employee',
            'password.required' => 'Password is required',
            'password.min' => 'Password should contain at least 6 characters',
        ]);

        $user = Guest::create([
            'name' => $request->input('fullname'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $userDetails = GuestDetails::create([
            'guest_id' => $user->id,   // reference for guest profile data.
        ]);

        $logs = $this->guestLog($request->ip(), "New registration", $user->id);
        
        Auth::guard('guest')->login($user);

        $message = "You have successfully logged in " . $request->fullname . ".";

        return redirect()->route('guest-home')->with(['icon'=>'success', 'message'=>$message]);
    }

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $guest = Guest::where('email', $incomingFields['email'])->first();

        // dd($incomingFields['email']);

        // dd(Hash::check($incomingFields['password'], $guest->password));

        if ($guest && Hash::check($incomingFields['password'], $guest->password)) {
            Auth::guard('guest')->login($guest);

            $logs = $this->guestLog($request->ip(), "Logged in", auth()->guard('guest')->user()->id);

            // $token = $guest->createToken('eAtithi')->plainTextToken;
            $message = "You have successfully logged in " . $guest->name . ".";

            $guestDetail = GuestDetails::where('guest_id', auth()->guard('guest')->user()->id)->first();

            if (!$guestDetail->nationality) {
                return redirect()->route('edit-profile')->with(['icon'=>'success', 'message'=>$message]);
            }

            return redirect()->route('guest-home')->with(['icon'=>'success', 'message'=>$message]);
        } else {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password'],
            ]);
        }
    }

    // public function profile () {
    //     return view('guest.user.profile');
    // }
    /*
    public function registration(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:3',
            'phone' => 'required|min:3',
            'email' => 'required|email|unique:guest,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required_with:password|same:password|min:6',
        ]);

        $user = Guest::create([
            'name' => $request->input('fullname'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $logs = $this->guestLog($request->ip(), "New registration", $user->id);
        
        Auth::login($user);

        return redirect()->route('guest-profile')->with('message', 'You have logged in successfully');
    }

    public function login(Request $request)
    {
        try {
            $incomingFields = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            $guest = Guest::where('email', $incomingFields['email'])->first();
    
            if ($guest && Hash::check($incomingFields['password'], $guest->password)) {
                Auth::login($guest);
    
                $logs = $this->guestLog($request->ip(), "Logged in", auth()->id());
    
                // $token = $guest->createToken('eAtithi')->plainTextToken;
                
                return redirect()->route('guest-profile')->with('message', 'logged in');
            } else {
                throw ValidationException::withMessages([
                    'email' => ['Invalid email or password'],
                ]);
            }

        } catch (e) {
            return 'e';
        }
    }  */

    public function logout(Request $request)
    {
        if (Auth::check()){
            $logs = $this->guestLog($request->ip(), "Logged out", auth()->id());
        }

        // Auth::user()->tokens()->delete();

        Auth::guard('guest')->logout();

        return redirect()->route('guest-login');
    }
    

    public function guestLog($ip = null, $activity = null, $guestId = null){
        // auto ip, auto time
        // custom activity, variable user id
        $data = [
            'ip_address' => $ip,
            'activity' => $activity,
            'guest_id' => $guestId,
        ];

        $logs = GuestsLogs::create($data);

        return $logs;
    }

}