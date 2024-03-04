<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Guesthouse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\GuestHouseHasEmployee;

class UsersController extends Controller
{
    // it is for the user created by super admin, or admin

    public function getAllSubUsers() {
        if (auth()->user()->roles[0]->name === 'super admin') {
            $allUsers = Admin::with('roles')
                            ->where('role', '!=', '1')->get();
        } else {
            $allUsers = Admin::with('roles')
                            ->where('role', '!=', '1')
                            ->where('role', '!=', '2')->get();
        }
        return response()->json($allUsers);
    }

    public function allSubUsers () {
        if (auth()->user()->roles[0]->name === 'super admin') {
            $allUsers = Admin::with('roles')
                            ->where('role', '!=', '1')->get();
        } else {
            $allUsers = Admin::with('roles')
                            ->where('role', '!=', '1')
                            ->where('role', '!=', '2')->get();
        }
        return view('guestHouse.Users.index', compact('allUsers'));
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


        $subUser = Admin::create([
            'admin_name' => $fields['fullname'],
            'phone' => $fields['phone'],
            'email' => $fields['email'],
            'role' => $fields['role'],
            'password' => bcrypt($fields['password']),
        ]);

        // for super admin
        if($request->guestHouse) {
            $fields = $request->validate(['guestHouse' => 'required']);

            // create relation for selected guest House
            $guestHouseEmployee = GuestHouseHasEmployee::create([
                'guest_house_id' => $request->guestHouse,
                'employee_id' => $subUser->id,
            ]);
        } else {
            // select all guestHouse id of the admin
            $guestHouse = GuestHouseHasEmployee::where('employee_id',auth()->user()->id)->pluck('guest_house_id');
            $guestHouseEmployee = GuestHouseHasEmployee::create([
                'guest_house_id' => $guestHouse->id,
                'employee_id' => $subUser->id,
            ]);
        }

        $role = Role::findById($subUser->role, 'web');
        
        $subUser->assignRole($subUser->role);
        $permissions = $role->permissions;
        // assigning permissions to the sub users
        $subUser->givePermissionTo($permissions);
        

        // return $request;

        return redirect()->route('all-sub-users')->with('message', 'a');
    }

    public function editSubUser($id) {
        $subUser = Admin::with('guestHouses')
                        ->where('id', $id)->first();

        // return $subUser;

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
            // return $guestHouses;
            return view('guestHouse.Users.edit', compact(['roles','guestHouses','subUser']));
        }
        // for admin
        // return $subUser;
        return view('guestHouse.Users.edit', compact(['roles','subUser']));

        // return view('guestHouse.Users.edit', compact('subUser'));
    }

    public function updateSubUser (Request $request, $id) {
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

        $subUser = Admin::where($id)
                        ->update();

        // $user->removeRole('writer');

        return $request;

        return redirect()->route('all-sub-users')->with('message', 'a');
    }
}
