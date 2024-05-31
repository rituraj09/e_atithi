<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Admin;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Http\Controllers\LogController;

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
        $adminId = auth()->guard('web')->user()->id;
        $admin = Admin::with(['roles','admin_info'])
                ->where('id', $adminId)
                ->first();

        $genders = Gender::all();
        // dd($admin);
        return view('guestHouse.Admin.profile', compact(['admin', 'genders']));
    }
}
