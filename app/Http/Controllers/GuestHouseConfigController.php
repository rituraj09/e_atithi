<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use App\Models\Districts;
use App\Models\Guesthouse;
use Illuminate\Http\Request;
use App\Models\GuestCategories;
use App\Models\GuestHouseHasEmployee;

class GuestHouseConfigController extends Controller
{
    //
    public function index() {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $guestHouse = Guesthouse::find($guest_house_id);

        $countries = Country::all();
        $states = State::where('country_id', $guestHouse->country)->get();
        $districts = Districts::where('state_id', $guestHouse->state)->get();

        return view('guestHouse.guestHouseConfig.index', compact(['countries', 'states', 'districts', 'guestHouse']));
    }

    public function update(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'district' => 'required',
            'PIN' => 'required',
            'guest_type' => 'required',
            'payment_type' => 'required',
            'base_price' => 'required',
        ], [
            'name.required' => 'Please enter a guest house name.',
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter a contact phone number.',
            'country.required' => 'Please select a country.',
            'state.required' => 'Please select a state.',
            'district.required' => 'Please select a district.',
            'PIN.required' => 'Please enter a PIN code.',
            'guest_type.required' => 'Please select a guest type',
            'payment_type.required' => 'Please select a payment type',
            'base_price.required' => 'Please enter a base price for all rooms.',
        ]);

        $guestHouse = Guesthouse::find($request->guestHouse_id);

        $isUpdate = $guestHouse->update([
            'name' => $request->name,
            'official_email' => $request->email,
            'contact_no' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'district' => $request->district,
            'pin' => $request->PIN,
            'guest_type' => $request->guest_type,
            'payment_type' => $request->payment_type,
            'base_price' => $request->base_price,
        ]);

        if (!$isUpdate) {
            return back()->with(['icon' => 'error', 'message' => 'Something is wrong']);
        }
        // return $isUpdate;
        return back()->with(['icon' => 'success', 'message' => 'Guest house config is updated successfully.']);
        
    }
}
