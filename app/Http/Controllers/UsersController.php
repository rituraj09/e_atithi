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
        $roles = Role::where('name', '!=', 'super admin')->get();
        $guestHouses = Guesthouse::with(['country_name', 'state_name', 'district_name'])->get();
        return view('guestHouse.Users.add', compact(['roles','guestHouses']));
    }
}
