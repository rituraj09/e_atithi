<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\GuestsLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
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
    }

    public function logout(Request $request)
    {
        if (Auth::check()){
            $logs = $this->guestLog($request->ip(), "Logged out", auth()->id());
        }

        Auth::user()->tokens()->delete();

        Auth::logout();

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































/*

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\GuestsLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registration (Request $request) {
    
        $incomingFields = $request;

        // $incomingFields = $request->validate([
        //     'fullname' => 'required|min:3',
        //     'phone' => 'required|min:3',
        //     'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:guest,email',
        //     'password' => 'required|min:6',
        //     'confirmPassword' => 'required_with:password|same:password|min:6'
        // ]);
        // if( $incomingFields->fails())
        // {
        //     return redirect()->back()->withErrors($incomingFields)->withInput();
        // }
    
        $incomingFields['password'] = bcrypt($request['password']);

        $user = Guest::create([
            'names' => $incomingFields['fullname'],
            'phone' => $incomingFields['phone'],
            'email' => $incomingFields['email'],
            'password' => $incomingFields['password'],

        ]);
       
        $data['ip_address']= $request->ip();
        $data['activity']= 'new registration';
        $data['guest_id']= $user['id'];
        // dd($data);
        // $log = GuestsLogs::create($data);
        $logs = GuestsLogs::create([
            'activity' => $data['activity'],
            'ip_address' => $data['ip_address'],
            'guest_id' => $data['guest_id']
        ]);

        // dd('log', $log);
    
        // return $user;

        Auth::login();

        return redirect()->route('/');
    }

    public function login(Request $request)
    {
        // return $request;
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // if (Auth::attempt($request)) {
        //     $request->session()->regenerate();
        //     return redirect()->route('welcome')->with('message', 'logged in');
        // }

        // $guest = Guest::where('email', $request->email)->first();

        // if ( Hash::check($request->password, $guest->password)) {
        //     return 'done';
        // }

        // return redirect()->route('guest-login');
        $guest = Guest::where('email', $request->email)->first();

        if ($guest && Hash::check($request->password, $guest->password)) {
            // $token = $guest->createToken('guest-token')->plainTextToken;
            $token = $guest->generateApiToken();

            return response()->json([
                'token' => $token,
                'message' => 'Authentication successful',
            ]);
        } else {
            return response()->json([
                'message' => 'Incorrect email or password',
            ], 401);
        }

    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    // $request->validate([
    //     // Other validation rules
    //     'captcha' => 'required|in:' . Session::get('captcha'),
    // ]);
    
} */
