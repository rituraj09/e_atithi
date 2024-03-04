<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Rooms;
use App\Models\States;
use App\Models\Countries;
use App\Models\Districts;
use App\Models\Guesthouse;
use Illuminate\Http\Request;
use App\Models\GuestHouseType;
use Spatie\Permission\Models\Role;
use App\Models\GuestHouseHasEmployee;

class GuestHouseController extends Controller
{
    // public
    public function getGuestHouses (Request $request) {
        $res = Guesthouse::select("name", "id")
                ->where('name', 'LIKE', '%' . $request->get('search') . '%')
                ->get();

        return response()->json($res);

        if ($request->ajax()) {
            return Guesthouse::select("name")
                ->where('name', 'LIKE', '%' . $request->get('search') . '%')
                ->get();
        }
        $guesthouses = Guesthouse::simplePaginate(10);

        return view('rooms.index', compact('guesthouses'));
    }

    public function getAvailableGuestHouse (Request $request) {
        $guestHouse = Guesthouse::select("id")
            ->where('name', $request->post('guest_house'))
            ->first();

        if ($guestHouse) {
            $guestHouseId = $guestHouse->id;

            $rooms = Rooms::select("name", "room_type", "capacity")
                ->where('guest_house_id', $guestHouseId)
                ->get();

                session([
                    'guestHouseId' => $guestHouseId,
                    'rooms' => $rooms,
                    'guestType' => $request->post('guest_type'),
                    'roomType' => $request->post('room_type'),
                    'guestHouseType' => $request->post('guest_house_type'),
                ]);

            return redirect()->route('available'); 
        } else {
            return response()->json(['message' => 'Guest house not found.']);
        }

    }

    // admin
    public function guestHouseDashboard () {
        return view('guestHouse.index');
    }

    public function allGuestHouses () {
        $guestHouses = Guesthouse::with(['country_name', 'state_name', 'district_name', 'admins'])->get();
        // dd($guestHouses[0]->admins[1]->admin_name);
        // $admins = 0;
        return view('guestHouse.GuestHouse.index', compact('guestHouses'));


        $guestHouses = Guesthouse::all();
        $countries = Countries::find($guestHouses->pluck('country')->toArray());
        dd($countries->pluck('name')->toArray());
        return view('guestHouse.GuestHouse.index', compact('guestHouses'));
    }

    public function addGuestHouse () {
        $guestHouseTypes = GuestHouseType::all();
        $countries = Countries::all();
        return view('guestHouse.GuestHouse.add', compact('guestHouseTypes', 'countries'));
    }

    public function editGuestHouse ($id) {
        $guestHouseTypes = GuestHouseType::all();
        $countries = Countries::all();
        $states = States::all();
        $districts = Districts::all();
        $roles = Role::where('name', '!=', 'super admin')->get();
        // fetch guest house data
        $guestHouse = Guesthouse::find($id);
        // select all employee id of the guest house
        $employeeId = GuestHouseHasEmployee::where('guest_house_id',$id)->pluck('employee_id');
        // select all employee of the guest house
        $employees = Admin::find([$employeeId]);
        return view('guestHouse.GuestHouse.edit', compact('guestHouse', 'roles', 'employees', 'guestHouseTypes', 'countries', 'states', 'districts'));
    }

    public function updateGuestHouse (Request $request) {
        // dd($request);
        $fields = $this->validateForm($request);

        // $fields = $request;

        $guestHouse = Guesthouse::find($request->id)->first();

        // dd($guestHouse);

        $isUpdate = $guestHouse->update($fields);

        // dd($isUpdate);

        if (!$isUpdate) {
            return redirect()->route('edit-guest-house', ['id' => $request->id])
                            ->with(['icon'=>'error', 'message'=>'Guest house data is not updated']);
        }

        return redirect()->route('all-guest-house')->with(['icon'=>'success', 'message'=>'Guest house is updated successfully']);
    }

    public function viewGuestHouse ($id) {
        $guestHouseTypes = GuestHouseType::all();
        $countries = Countries::all();
        $states = States::all();
        $districts = Districts::all();
        $roles = Role::where('name', '!=', 'super admin')->get();
        // fetch guest house data
        $guestHouse = Guesthouse::find($id);
        // select all employee id of the guest house
        $employeeId = GuestHouseHasEmployee::where('guest_house_id',$id)->pluck('employee_id');
        // select all employee of the guest house
        $employees = Admin::find([$employeeId]);
        return view('guestHouse.GuestHouse.view', compact('guestHouse', 'roles', 'employees', 'guestHouseTypes', 'countries', 'states', 'districts'));
    }

    public function addNewGuestHouses (Request $request) {
        // return "hello";
        $fields = $this->validateForm($request);

        $fields = $request->validate([
            // admin part
            'admin_name' => 'required|min:3',
            'admin_email' => 'required|email|unique:admins,email',
            'admin_phone' => 'required|min:10',
        ]);

        $fields['admin_password'] = bcrypt($this->passwordGenerator());
        $fields['admin_role'] = 2;  // admin role id


        $admin = Admin::create([
            'admin_name' => $fields['admin_name'],
            'phone' => $fields['admin_phone'],
            'email' => $fields['admin_email'],
            'role' => $fields['admin_role'],
            'password' => $fields['admin_password'],
        ]);

        $guestHouse = Guesthouse::create([
            'name' => $fields['name'],
            'official_email' => $fields['email'],
            'contact_no' => $fields['phone'],
            'address' => $request['address'],
            'district' => $fields['district'],
            'state' => $fields['state'],
            'country' => $fields['country'],
            'pin' => $fields['pin'],
            'guest_house_type' => $fields['guestHouseType'],
        ]);

        $guestHouseEmployee = GuestHouseHasEmployee::create([
            'guest_house_id' => $guestHouse->id,
            'employee_id' => $admin->id,
        ]);


        // dd($guestHouseEmployee, $guestHouse->id, $admin->id);
        $role = Role::findById($admin->role, 'web');
        
        $admin->assignRole($admin->role);
        $permissions = $role->permissions;
        // assigning permissions to the sub users
        $admin->givePermissionTo($permissions);

        if (!$guestHouse || !$admin || !$guestHouseEmployee) {
            // return $guestHouseEmployee;
            return response()->with('error');
        }

        return redirect()->route('all-guest-house');
    }

    public function passwordGenerator () {

        return "admin123";

        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $password = '';
    
        $charLength = strlen($chars);
    
        // Generate a random password of length 6
        for ($i = 0; $i < 6; $i++) {
            $randomIndex = mt_rand(0, $charLength - 1);
            $password .= $chars[$randomIndex];
        }
    
        // Return the generated password
        return $password;
    }

    public function validateForm($request) {
        return $request->validate([
            'name' => 'required|min:3',
            'guestHouseType' => 'required',
            'email' => 'required|email|unique:guesthouses,official_email,'. $request->id,
            'phone' => 'required|min:10',
            'country' => 'required',
            'state' => 'required',
            'district' => 'required',
            'pin' => 'required',
        ]);
    }
}
