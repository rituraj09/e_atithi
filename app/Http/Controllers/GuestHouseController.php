<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Rooms;
use App\Models\State;
use App\Models\Country;
use App\Models\Districts;
use App\Models\Guesthouse;
use Illuminate\Http\Request;
use App\Models\GuestHouseType;
use Spatie\Permission\Models\Role;
use App\Models\GuestHouseHasEmployee;

class GuestHouseController extends Controller
{
    // public
    public function searchGuestHouse (Request $request) {

        $guestHouses = Guesthouse::where('name', 'like', '%' . $request->guestHouse . '%')
                        ->with('district_name')
                        ->get();

        return $guestHouses;
    }

    public function getGuestHouses (Request $request) {
        // return $request;

        $res = Guesthouse::where('name', $request->guestHouse )
                ->with(['district_name','state_name'])
                ->get();
        
        return $res;

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
        $countries = Country::find($guestHouses->pluck('country')->toArray());
        // dd($countries->pluck('name')->toArray());
        return view('guestHouse.GuestHouse.index', compact('guestHouses'));
    }

    public function addGuestHouse () {
        $guestHouseTypes = GuestHouseType::all();
        $countries = Country::all();
        return view('guestHouse.GuestHouse.add', compact('guestHouseTypes', 'countries'));
    }

    public function editGuestHouse ($id) {
        $guestHouseTypes = GuestHouseType::all();
        $countries = Country::all();
        $states = State::all();
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
        $countries = Country::all();
        $states = State::all();
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

        // dd($fields);

        $adminFields = $request->validate([
            // admin part
            'admin_name' => 'required|min:3',
            'admin_email' => 'required|email|unique:admins,email',
            'admin_phone' => 'required|min:10',
        ],[
            'admin_name.required' => 'Please enter a correct admin name',
            'admin_email.required' => 'Please enter a correct email address',
            'admin_email.unique' => 'Email address already exist',
            'admin_phone.required' => 'Please enter a correct 10-digit phone number',
        ]);

        // $guestHouseImage = $request->file('guestHouseImage');
        // $guestHouseImageName = null;
        // if ($guestHouseImage) {
        //     $guestHouseImageName = time() . '.' . $guestHouseImage->getClientOriginalExtension();
        //     $guestHousePath = $guestHouseImage->storeAs('public/images', $guestHouseImage);
        // }

        $adminFields['admin_password'] = bcrypt($this->passwordGenerator());
        $adminFields['admin_role'] = 2;  // admin role id

        // dd($fields);

        $admin = Admin::create([
            'admin_name' => $adminFields['admin_name'],
            'phone' => $adminFields['admin_phone'],
            'email' => $adminFields['admin_email'],
            'role' => $adminFields['admin_role'],
            'password' => $adminFields['admin_password'],
        ]);

        if (!$admin) {
            return redirect()->route('add-guest-house')->with(['icon'=>'error', 'message'=>'Error in admin']);
        }

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
            ''
        ]);

        if (!$guestHouse) {
            return redirect()->route('add-guest-house')->with(['icon'=>'error', 'message'=>'Error in guest house']);
        }

        $guestHouseEmployee = GuestHouseHasEmployee::create([
            'guest_house_id' => $guestHouse->id,
            'employee_id' => $admin->id,
        ]);

        if (!$guestHouseEmployee) {
            return redirect()->route('add-guest-house')->with(['icon'=>'error', 'message'=>'Error in guest house has employee']);
        }


        // dd($guestHouseEmployee, $guestHouse->id, $admin->id);
        $role = Role::findById($admin->role, 'web');
        
        $admin->assignRole($admin->role);
        $permissions = $role->permissions;
        // assigning permissions to the sub users
        $admin->givePermissionTo($permissions);

        if (!$guestHouse || !$admin || !$guestHouseEmployee) {
            // return $guestHouseEmployee;
            return response()->with(['icon'=>'error', 'message'=>'Error in ']);
        }

        return redirect()->route('all-guest-house')->with(['icon'=>'success', 'message'=>'New guest houses added successfully']);
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
        ],[
            'name.required' => 'Please enter a name for the guest house',
            'guestHouseType.required' => 'Please select a guest house type',
            'email.required' => 'Please enter an email address',
            'email.unique' => 'Email address already exist',
            'phone.required' => 'Please enter a phone number',
            'country.required' => 'Please select the country name',
            'state.required' => 'Please select the state name',
            'district.required' => 'Please select the district name',
            'pin.required' => 'Please enter the PIN code',
        ]);
    }

    public function searchLocations (Request $request) {
        $locations = Districts::where('name', 'like', '%' . $request->guestHous . '%')
                                ->get();

        return $locations;
    }
}
