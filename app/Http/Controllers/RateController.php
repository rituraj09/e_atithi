<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RateController extends Controller
{
    //
    public function allRoomRates () {
        return view('guestHouse.Rate.index');
    }

    public function editRoomRate ($id) {

    }

    public function addRoomRate () {
        $roomCategories = RoomCategory::all();
        return view('guestHouse.Rate.add', compact('roomCategories'));
    }

    public function newRoomRate (Request $request) {

    }
}
