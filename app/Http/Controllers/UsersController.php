<?php

namespace App\Http\Controllers;

use App\Models\Guesthouse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    // it is for the user created by super admin, or admin

    public function allSubUsers() {
        return view('guestHouse.Users.index');
    }

    public function addSubUsers() {
        if (auth()->user()->roles[0]->name  === 'admin') {
            $roles = Role::where('name', '!=', 'super admin' )
                        ->where('name', '!=', 'admin')
                        ->get();
        } else {
            // dd(auth()->user()->roles());
            $roles = Role::where('name', '!=', 'super admin')->get();
        }

        // for super admin
        if (auth()->user()->roles[0]->name === 'super admin') {
            $guestHouses = Guesthouse::with(['country_name', 'state_name', 'district_name'])->get();
            return view('guestHouse.Users.add', compact(['roles','guestHouses']));
        }

        // for admin
        return view('guestHouse.Users.add', compact('roles'));
    }

    public function storeSubUser (Request $request) {
        // common validation
        $fields = $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required',
        ]);

        // for super admin
        if($request->guestHouse) {
            $fields = $request->validate(['guestHouse' => 'required']);
        }

        return $request;

        return response()->json(['message' => 'hello']);
    }
}
