<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\RateList;
use App\Models\RoomCategory;
use App\Models\RoomFeatures;
use Illuminate\Http\Request;
use App\Models\GuestHouseHasEmployee;

class RoomController extends Controller
{
    //
    public function getRoom () {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        
        $rooms = Rooms::with('roomRate')
                        ->where('guest_house_id', $guest_house_id)
                        ->get();

        return view('guestHouse.Rooms.index', compact('rooms'));
    }

    public function addRoomView() {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        if(!$guest_house_id) {
            return response()->json('no');
        }
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();
       
        $roomRates = RateList::with('roomCategory')
                            ->where('guest_house_id', $guest_house_id)
                            ->get();


        if (!$roomCategories) {
            return view('guestHouse.Rooms.addRoom');
        }

        // echo $roomCategories;

        return view('guestHouse.Rooms.addRoom', compact(['roomCategories', 'roomRates']));
    }

    public function getAllRooms () {
        $rooms = Rooms::all();

        if (!$rooms) {
            return view('guestHouse.Rooms.index');
        }

        return view('guestHouse.Rooms.index', ['rooms' => $rooms]);
    }

    public function addRoom (Request $request) {
        // dd($request);

        $request->validate([
            'roomNumber' => 'required|unique:rooms,room_number',
            'price' => 'required',
            'numberOfBeds' => 'required',
            'capacity' => 'required',
            'roomCategory' => 'required',
        ]);

        // dd($request);

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $room = Rooms::create([
            'room_number' => $request->roomNumber,
            'guest_house_id' => $guest_house_id,
            'room_rate' => $request->roomCategory,
            'no_of_beds' => $request->numberOfBeds,
            'capacity' => $request->capacity,
            'width' => $request->width || null,
            'length' => $request->length || null,
        ]);

        if (!$room) {
            return redirect()->route('guest-house-admin-add-room')->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }

        // dd($request);

        return redirect()->route('guest-house-admin-rooms')->with(['icon'=>'success','message'=>'Room added successfull']);
    }

    public function editRoom ($id) {
        $room = Rooms::where('id', $id)
                    ->with('roomRate')
                    ->first();

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();
        
        $roomRates = RateList::with('roomCategory')
                            ->where('guest_house_id', $guest_house_id)
                            ->get();

        // dd($room);

        if (!$room) {
            return view('guestHouse.Rooms.editRoom');
        }
        return view('guestHouse.Rooms.editRoom', compact(['room','roomRates', 'roomCategories']));
    }

    public function viewRoom($id) {
        $room = Rooms::where('id', $id)
                    ->with('roomRate')
                    ->first();

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();
        
        $roomRates = RateList::with('roomCategory')
                            ->where('guest_house_id', $guest_house_id)
                            ->get();

        $features = RoomFeatures::where('room_id', $room->id)
                                ->get();

        // dd($features);

        // dd($room);

        if (!$room) {
            return view('guestHouse.Rooms.viewRoom');
        }   
        return view('guestHouse.Rooms.viewRoom', compact(['room','roomRates', 'roomCategories', 'features']));
    }
}
