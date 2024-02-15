<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class GuestHouseAdminController extends Controller
{
    //
    public function registration () {
        $roles = Role::all();
        
        return view('guestHouse.Admin.registration', ['roles' => $roles]);
    }

    public function login () {
        return view('guestHouse.Admin.login');
    }

    public function profile () {
        return view('guestHouse.GuestHouseProfile.index');
    }
}
