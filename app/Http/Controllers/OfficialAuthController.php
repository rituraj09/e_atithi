<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OfficialAuthController extends Controller
{
    public function registration(Request $request)
    {
        $fields = $request->validate([
            'fullname' => 'required|min:3',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|min:10',
            'role' => 'required',
            'password' => 'required|min:6',
            'confirmPassword' => 'required_with:password|same:password|min:6',
        ]);

        $fields['password'] = bcrypt($fields['password']);

        // dd($fields);

        $admin = Admin::create([
            'admin_name' => $fields['fullname'],
            'phone' => $fields['phone'],
            'email' => $fields['email'],
            'role' => $fields['role'],
            'password' => $fields['password'],
        ]);

        // dd($admin);

        if ($admin) {
        // Authenticate user
            Auth::login($admin);

            return redirect()->route('guest-house-admin-dashboard')->with(['message' => 'Logged in successfully']);
        }

        return redirect()->route('guest-house-admin-registration');
    }

    public function login(Request $request)
    {
        // if (auth()->check()) {
        //     // User is already logged in, handle accordingly
        //     Auth::user()->tokens()->delete();

        //     Auth::logout();
        //     return redirect()->route('guest-house-admin-dashboard');
            
        //     return response()->json(['message' => 'User is already logged in'], 400);
        // }
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // $admin = Admin::where('email', $request->email)->first();
        $admin = Admin::with('roles')->where('email', $request->email)->first();

        // dd($admin->role);

        if (!$admin || !Hash::check($fields['password'], $admin->password)) {
            return response()->json([
                'message' => 'Wrong credentials'
            ], 401);
        }

        // dd($admin->roles->name);
        // Authenticate user
        Auth::login($admin);

        // dd(auth()->check(), $admin->roles->name);

        // Redirect to dashboard
        return redirect()->route('guest-house-admin-dashboard')->with('roles', $admin->role);
    }

    
}






/*

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\GuestHouseAdmin;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Laravel\Sanctum\HasApiTokens;

// class Admin extends Authenticatable


class OfficialAuthController extends Controller
{
    //

    public function registration (Request $request) {
        $request->validate([
            'fullname' => 'required|min:3',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|min:10',
            'role' => 'required',
            'password' => 'required|min:6',
            'confirmPassword' => 'required_with:password|same:password|min:6',
        ]);

        $guestHouseAdmin = Admin::create([
            'admin_name' => $request->input('fullname'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Auth::login($guestHouseAdmin);

        // return redirect()->route('guest-house-admin-dashboard');

        $token = $guestHouseAdmin->createToken('admin')->plainTextToken;

        return redirect()->route('guest-house-admin-dashboard')->with([
            'token' =>$token,
            'Type' => 'Bearer',
            'role' => $request->input('role'),
        ]);

    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|email|unique:guest,email',
            'password' => 'required|min:6',
        ]);

        $guestHouseAdmin = Admin::where('email', $fields['email'])->first();

        if (!$guestHouseAdmin || !Hash::check(bcrypt($fields['password']), $guestHouseAdmin->password)) {
            return response([
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $guestHouseAdmin->createToken('guest')->plainTextToken;

        return response()->json([
            'token' =>$token,
            'Type' => 'Bearer',
            'role' => $user->role,
        ]);        

    }

} */
