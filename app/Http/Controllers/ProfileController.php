<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Models\GuestCategories;

class ProfileController extends Controller
{
    //
    public function updateProfile(Request $request) {

        $incomingFields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'dob' => 'required',
            'guest_type' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'id_card_no' => 'required',
            'id_card_type' => 'required',

        ]);

        $guest = Guest::find(auth()->id());

        $guest->update([
            'name' => $request->input('names'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'guestcategory_id' => $request->input('guest_type'),
            'nationality' => $request->input('nationality'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'id_card_no' => $request->input('id_card_no'),
            'id_card_type' => $request->input('id_card_type'),
            'remarks' => $request->input('remarks'),
        ]);

        $activity = "profile update";

        $data = [
            'ip_address' => $request->ip(),
            'activity' => 'new registration',
            'guest_id' => auth()->id(),
        ];

        $logs = GuestsLogs::create($data);

        // $guestId->update($request->all());

        return $incomingFields;

    }

    public function getGuestCategories () {
        $guestCategory = GuestCategories::all();
        return view('guest.profile', ['guest_categories' => $guestCategory])->name('guest-categories');
    }

    public function getProfile () {
        if (auth()->check()) {
            $guest = Guest::find(auth()->id());
            $guestCategories = GuestCategories::all();
            $genders = Gender::all();
            return view('guest.profile', [
                'guest' => $guest, 
                'guestCategories' => $guestCategories,
                'genders' => $genders,
            ]);
        }         
        return view('guest.login');
    }
}
