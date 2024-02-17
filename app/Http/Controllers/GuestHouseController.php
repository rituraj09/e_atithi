<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Countries;
use App\Models\Guesthouse;
use Illuminate\Http\Request;
use App\Models\GuestHouseType;

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

            // Fetch room details based on guest house ID
            // if ($request->post('room_type'))
            $rooms = Rooms::select("name", "room_type", "capacity")
                ->where('guest_house_id', $guestHouseId)
                ->get();
            // return $rooms[0]->room_type;

            // $roomType = RoomType::select("name")
            //     ->where('id', $rooms->room_type)
            //     ->get();

                session([
                    'guestHouseId' => $guestHouseId,
                    'rooms' => $rooms,
                    'guestType' => $request->post('guest_type'),
                    'roomType' => $request->post('room_type'),
                    'guestHouseType' => $request->post('guest_house_type'),
                ]);

            return redirect()->route('available'); 

            // return response()->json(['guestHouseId' => $roomId, 'rooms' => $rooms]);
        } else {
            return response()->json(['message' => 'Guest house not found.']);
        }

    }

    // admin
    public function guestHouseDashboard () {
        return view('guestHouse.index');
    }

    public function allGuestHouses () {
        $guestHouses = Guesthouse::all();
        return view('guestHouse.GuestHouse.index', compact('guestHouses'));
    }

    public function addGuestHouses () {
        $guestHouseTypes = GuestHouseType::all();
        $countries = Countries::all();
        return view('guestHouse.GuestHouse.add', compact('guestHouseTypes', 'countries'));
    }

    public function addNewGuestHouses (Request $request) {
        // return "hello";
        $fields = $request->validate([
            'name' => 'required|min:3',
            'guestHouseType' => 'required',
            'email' => 'required|email|unique:guesthouses,official_email',
            'phone' => 'required|min:10',
            'country' => 'required',
            'state' => 'required',
            'district' => 'required',
            'pin' => 'required',
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


        if (!$guestHouse) {
            return response()->with('error');
        }

        return redirect()->route('all-guest-house');
    }
}
