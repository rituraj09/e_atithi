<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Admin;
use App\Models\Gender;
use App\Models\AdminDetails;
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

    public function updateProfile (Request $request) {

        $profileImage = $request->file('profile');
        $profileImageName = null;
        if ($profileImage) {
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profilePath = $profileImage->storeAs('public/images', $profileImageName);
        }

        $admin_id = auth()->guard('web')->user()->id;

        $adminInfo = AdminDetails::find($admin_id);

        if ($adminInfo) {
            $isUpdate = $adminInfo->update([
                'nationality' => $request->nationality,
                'address' => $request->address,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'profile_pic' => $profileImageName ?: $adminInfo->profile_pic,
            ]);
        } else {
            $isUpdate = AdminDetails::create([
                'admin_id' => $admin_id,
                'nationality' => $request->nationality,
                'address' => $request->address,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'profile_pic' => $profileImageName,
            ]);
        }

        if (!$isUpdate) {
            return back()->with(['icon'=>'error','message'=>'Something went wrong']);
        } else {
            return back()->with(['icon'=>'success','message'=>'Profile updated successfully.']);
        }
    }
}
