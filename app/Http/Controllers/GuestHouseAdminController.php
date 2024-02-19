<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Admin;
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
        $adminId = auth()->user()->id;
        $admin = Admin::with('roles')
                ->where('id', $adminId)
                ->first();
        // dd($admin);
        return view('guestHouse.GuestHouseProfile.index', compact('admin'));
    }
}
