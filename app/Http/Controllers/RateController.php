<?php

namespace App\Http\Controllers;

use App\Models\RateList;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use App\Models\GuestHouseHasEmployee;

class RateController extends Controller
{
    //
    public function getCategoryPrice (Request $request) {
        $category = RateList::with('roomCategory')
                        ->find($request->rateId);
        return $category->roomCategory;
    }

    public function allRoomRates () {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $roomRates = RateList::with('roomCategory')
                            ->where('guest_house_id', $guest_house_id)
                            ->get();


        if (!$roomRates) {
            return view('guestHouse.Rate.index');
        }

        return view('guestHouse.Rate.index', compact('roomRates'));
    }

    public function editRoomRate ($id) {
        $roomCategories = RoomCategory::all();
        $roomRate = RateList::find($id)->first();
        
        if(!$roomRate) {
            return view('guestHouse.Rate.index');
        }
        return view('guestHouse.Rate.edit', compact(['roomRate', 'roomCategories']));
    }

    public function updateRoomRate (Request $request) {
        $fields = $request->validate([
            'name' => 'required',
            'room_category' => 'required',
            'price' => 'required',
            'id' => 'required',
        ]);

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $roomRate = RateList::find($request->id)->first();

        $roomRate->update($request->all());
        return redirect()->route('room-rates')
          ->with(['icon'=> 'success', 'message' => 'Rate is successfully updated.']);

    }

    public function addRoomRate () {
        $roomCategories = RoomCategory::all();
        return view('guestHouse.Rate.add', compact('roomCategories'));
    }

    public function newRoomRate (Request $request) {
        $fields = $request->validate([
            'name' => 'required',
            'roomCategory' => 'required',
            'rate' => 'required',
        ]);

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        // dd($request, $guest_house_id);

        $isRate = RateList::create([
            'name' => $fields['name'],
            'guest_house_id' => $guest_house_id,
            'room_category' => $fields['roomCategory'],
            'price' => $fields['rate'],
        ]);

        if (!$isRate) {
            return redirect()->route('room-rates')->with(['message' => 'Something went wrong', 'icon' => 'error']);
        }
        return redirect()->route('room-rates')->with(['message' => 'New room rate added successfully', 'icon' => 'success']);
    }

    public function deleteRoomRate (Request $request) {
        $rate = RateList::find($request->id);
        $rate->delete();

        return redirect()->route('room-rates')->with(['icon'=>'success', 'message'=>'Rate is deleted successfully']);
    }
}
