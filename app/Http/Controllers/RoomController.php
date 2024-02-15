<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    public function roomView () {
        return view('guestHouse.Rooms.index');
    }

    public function addRoomView() {
        $guest_house_id = 1; //testing value
        $roomCategories = RoomCategory::select("id", "name")
            ->where('guest_house_id', $guest_house_id)
            ->get();

        if (!$roomCategories) {
            return view('guestHouse.Rooms.addRoom');
        }

        // echo $roomCategories;

        return view('guestHouse.Rooms.addRoom', ['roomCategories' => $roomCategories]);
    }

    public function getAllRooms () {
        $rooms = Rooms::all();

        if (!$rooms) {
            return view('guestHouse.Rooms.index');
        }

        return view('guestHouse.Rooms.index', ['rooms' => $rooms]);
    }

    public function addRoom (Request $request) {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number',

        ]);
        return $request;
    }

    public function editRoom (Request $request) {

    }
}
