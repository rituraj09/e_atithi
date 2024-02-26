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
        // dd(auth()->user()->id);
        // if (!$guest_house_id) {
        //     return view('guestHouse.RoomCategory.index');
        // }
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();

        // if( !$roomCategories ) {
            $roomCategory = NULL;
            return view('guestHouse.RoomCategory.index', compact('roomCategory'));
        // }

        return view('guestHouse.RoomCategory.index', compact('roomCategories'));
    }

    // all
    public function getAllRoomCategories () {
        // $guest_house_id = 1; //testing value
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        if(!$guest_house_id) {
            return response()->json('no');
        }
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();
        // dd($roomCategories);
        if (!$roomCategories) {
            return response()->json('null');
        }
        return response()->json(['data' => $roomCategories]);
    }

    public function storeRoomCategory (Request $request) {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        // validation
        $request->validate([
            'category' => 'required|min:3',
        ]);

        $category = strtolower($request->input('category'));

        // Check if the room category already exists for the guest house
        $existingCategory = RoomCategory::where('guest_house_id', $guest_house_id)
            ->whereRaw('LOWER(name) = ?', [$category])
            ->first();

        // existance check
        if ($existingCategory) {

            // may be exist but deleted, it will recover
            if ($existingCategory->is_delete === 1) {
                RoomCategory::where($existingCategory->id)
                        ->update(['is_delete' => 0]);
            }
            // return update refreshed data
            return response()->json([
                'message' => 'Room category already exists for this guest house', 
                'icon' => 'warning'
            ]);
        }

        // return $request->id;

        if ($request->id) {
            // update existing room category
            $roomCategory = RoomCategory::where($request->id)
                                        ->update(['name' => $request->input('category')]);

            return $roomCategory;

            if (!$roomCategory) {
                return response()->json([
                    'message'=>'Failed to update room category',
                    'icon' => 'error'
                ]);
            }
            return response()->json([
                'message'=>'Room category updateded successfully',
                'icon' => 'success'
            ]);

        } else {
        
            // new room category
            $roomCategory = RoomCategory::create([
                'name' => $request->input('category'),
                'guest_house_id' => $guest_house_id,
                'created_by' => auth()->id(),
            ]);

            if (!$roomCategory) {
                return response()->json([
                    'message'=>'Failed to add room category',
                    'icon' => 'error'
                ]);
            }
            return response()->json([
                'message'=>'Room category added successfully',
                'icon' => 'success'
            ]);
        }
    }

    // edit view
    public function editRoomCategory ($id) {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        $roomCategory = RoomCategory::find($id)
                        ->where('guest_house_id', $guest_house_id)
                        ->first();
        // return $roomCategory;
        return view('guestHouse.RoomCategory.edit', compact('roomCategory'));
    }

    // delete
    public function deleteRoomCategory (Request $request) {
        // return $request->id;
        $roomCategory = RoomCategory::where($request->id)
                                    ->update(['is_delete'=>1, 'is_active'=>0]);
        return 'done';
    }
}
