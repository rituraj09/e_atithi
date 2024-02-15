<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    //
    public function roomCategories () {
        $guest_house_id = 1;
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();

        return view('guestHouse.RoomCategory.index', compact(roomCategories));
    }


    public function getAllRoomCategories () {
        $guest_house_id = 1; //testing value
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();

        return response()->json(['data' => $roomCategories]);
    }

    public function addRoomCategory (Request $request) {

        // testing value
        $guest_house_id = 1;

        $request->validate([
            'category' => 'required|min:3',
        ]);

        $category = strtolower($request->input('category'));

        // Check if the room category already exists for the guest house
        $existingCategory = RoomCategory::where('guest_house_id', $guest_house_id)
            ->whereRaw('LOWER(name) = ?', [$category])
            ->first();

        if ($existingCategory) {
            return response()->json(['message' => 'Room category already exists for this guest house']);
        }

        $roomCategory = RoomCategory::create([
            'name' => $request->input('category'),
            'guest_house_id' => $guest_house_id,
            'created_by' => auth()->id(),
        ]);

        if (!$roomCategory) {
            return response()->json(['message'=>'Failed to add room category']);
        }

        return response()->json(['message'=>'Room category added successfully']);
    }

    public function deleteRoomCategory (Request $request) {
        
    }
}
