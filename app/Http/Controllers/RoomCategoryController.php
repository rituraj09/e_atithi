<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;
use App\Models\GuestHouseHasEmployee;

class RoomCategoryController extends Controller
{
    //
    public function roomCategories () {

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)
                                    ->get();

        // if( !$roomCategories ) {
            // $roomCategory = NULL;
            // return view('guestHouse.RoomCategory.index', compact('roomCategory'));
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
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)
                                    ->get();
        // dd($roomCategories);
        if (!$roomCategories) {
            return response()->json('null');
        }
        return response()->json(['data' => $roomCategories]);
    }

    public function storeRoomCategory (Request $request) {
        // dd($request);

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)
                                                ->pluck('guest_house_id')
                                                ->first();

        // validation
        $request->validate([
            'categoryName' => 'required|min:3',
            'price_modifier' =>'required',
        ]);

        // echo $request;

        $categoryName = strtolower($request->input('categoryName'));

        // Check if the room category already exists for the guest house
        $existingCategory = RoomCategory::where('guest_house_id', $guest_house_id)
            ->whereRaw('LOWER(name) = ?', [$categoryName])
            ->first();

        // existance check
        if ($existingCategory) {

            // may be exist but deleted, it will recover
            if ($existingCategory->is_delete === 1) {
                RoomCategory::where($existingCategory->id)
                        ->update(['is_delete' => 0]);
            }
            // return update refreshed data
            return redirect()->route('add-room-category')->with([
                'message' => 'Room category already exists for this guest house', 
                'icon' => 'warning'
            ]);
        }

        
        // new room category
        $roomCategory = RoomCategory::create([
            'name' => $request->input('categoryName'),
            'price_modifier' => $request->input('price_modifier'),
            'guest_house_id' => $guest_house_id,
            'created_by' => auth()->id(),
        ]);

        if (!$roomCategory) {
            return redirect()->route('add-room-category')->with([
                'message'=>'Failed to add room category',
                'icon' => 'error'
            ]);
        }
        return redirect()->route('room-category')->with([
            'message'=>'Room category added successfully',
            'icon' => 'success'
        ]);
    }

    public function updateRoomCategory(Request $request) {
        $request->validat([
            'name' => 'required|min:3',
            'price_modifier' => 'required',
            'id' => 'required',
        ]);

         // update existing room category
        $roomCategory = RoomCategory::where($request->id)
                                    ->update([
                                        'name' => $request->input('category'),
                                        'price_modifier' => $request->input('price_modifier'),
                                    ]);

        if (!$roomCategory) {
            return redirect()->route('add-room-category')->with([
                'message'=>'Failed to update room category',
                'icon' => 'error'
            ]);
        }
        return redirect()->route('room-category')->with([
            'message'=>'Room category updateded successfully',
            'icon' => 'success'
        ]);
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

    public function addRoomCategory() {
        return view('guestHouse.RoomCategory.add');
    }
}
