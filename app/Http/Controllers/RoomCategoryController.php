<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;
use App\Models\GuestHouseHasEmployee;

class RoomCategoryController extends Controller
{
    //
    public function roomCategories () {
        // $guest_house_id = 1;
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        // dd($guest_house_id);
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();

        return view('guestHouse.RoomCategory.index', compact('roomCategories'));
    }


    public function getAllRoomCategories () {
        // $guest_house_id = 1; //testing value
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();

        return response()->json(['data' => $roomCategories]);
    }

    public function addRoomCategory (Request $request) {

        // testing value
        // $guest_house_id = 1;
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

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

    public function editRoomCategory ($id) {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        $roomCategory = RoomCategory::find($id)
                        ->where('guest_house_id', $guest_house_id)
                        ->first();
        // return $roomCategory;
        return response()->json($roomCategory, 200);
    }

    public function deleteRoomCategory (Request $request) {
        // return $request->id;
        $roomCategory = RoomCategory::where($request->id)
                                    ->update(['is_delete'=>1, 'is_active'=>0]);
        return 'done';
    }
}
