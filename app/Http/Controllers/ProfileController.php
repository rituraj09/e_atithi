<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Gender;
use App\Models\IdCardType;
use App\Models\GuestDetails;
use Illuminate\Http\Request;
use App\Models\GuestCategories;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function updateProfile(Request $request) {

        $idCardImage = $request->file('id_card_file');
        $idCardImageName = null;
        if ($idCardImage) {
            $idCardImageName = time() . '.' . $idCardImage->getClientOriginalExtension();
            $idCardPath = $idCardImage->storeAs('public/images', $idCardImageName);
        }

        $profileImage = $request->file('profile_pic');
        $profileImageName = null;
        if ($profileImage) {
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profilePath = $profileImage->storeAs('public/images', $profileImageName);
        }

        $guest = Guest::find(auth()->guard('guest')->id());

        $guestDetail = GuestDetails::where('guest_id', $guest->id)->first();

        $guest->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        $guestDetail->update([
            'dob' => $request->input('dob'),
            'guestcategory_id' => $request->input('guest_type'),
            'nationality' => $request->input('nationality'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'profile_pic' => $profileImageName ?: $guestDetail->profile_pic,
            'id_card_file' => $idCardImageName ?: $guestDetail->id_card_no,
            'id_card_number' => $request->input('id_card_number'),
            'id_card_type' => $request->input('id_card_type'),
            'remarks' => $request->input('remarks'),
        ]);

        // $activity = "profile update";

        // $data = [
        //     'ip_address' => $request->ip(),
        //     'activity' =>  $activity,
        //     'guest_id' => auth()->guard('guest')->id(),
        // ];

        // $logs = GuestsLogs::create($data);

        return redirect()->route('guest-profile')->with(['icon'=>'success', 'message' => 'Guest profile updated']);

    }

    public function getGuestCategories () {
        $guestCategory = GuestCategories::all();
        return view('guest.profile', ['guest_categories' => $guestCategory])->name('guest-categories');
    }

    public function getProfile () {
        // return view('guest.user.profile');
        // if (auth()->check()) {
        $guest = Guest::find(auth()->guard('guest')->id());

        // $guestDetail = GuestDetails::where('guest_id', auth()->guard('guest')->user()->id)->first();

        $guestDetail = GuestDetails::where('guest_id', auth()->guard('guest')->user()->id)->first();
        // dd($guest);
        if (!$guestDetail->nationality) {
            return redirect()->route('edit-profile')->with(['icon'=>'warning', 'message'=>"Please update your profile first"]);
        }

        if ($guest) {
            $guestCategories = GuestCategories::all();
            $genders = Gender::all();
            return view('guest.user.profile', [
                'guest' => $guest, 
                'guestCategories' => $guestCategories,
                'genders' => $genders,
                'guestDetail' => $guestDetail,
            ]);
        }
        // }         
        return view('guest.user.login');
    }

    public function editPassword() {
        $guestDetail = GuestDetails::where('guest_id', auth()->guard('guest')->user()->id)->first();

        if ( !$guestDetail->nationality ) {
            return redirect()->route('edit-profile')->with(['icon'=>'warning', 'message'=>"Please update your profile first"]);
        }
        return view('guest.user.updatePassword');
    }

    public function updatePassword(Request $request) {

        $request->validate([
            'password' => 'required',
            'confirmPassword' => 'required',
        ]);

        return view('guest.user.updatePassword');
    }

    public function editProfile () {
        $id = auth()->guard('guest')->id();

        $guestCategories = GuestCategories::all();

        $genders = Gender::all();

        $guestDetails = GuestDetails::with('guest')->where('guest_id',$id)->first();

        $idCardTypes = IdCardType::all();

        return view('guest.user.editProfile', compact(['guestCategories','guestDetails', 'genders', 'idCardTypes']));
    }

}
