<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;
use App\Models\RoomCategoryHasPrice;
use App\Models\GuestHouseHasEmployee;

class RoomCategoryPriceController extends Controller
{
    //
    public function index() {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        
        $roomCategories = RoomCategoryHasPrice::with('Category')->where('guest_house_id',$guest_house_id)->get();
        
        return view('guestHouse.RoomCategoryPrice.index', compact('roomCategories'));
    }

    public function store (Request $request) {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        
        $request->validate([
            'category' => 'required',
        ]);

        $res = RoomCategoryHasPrice::create([
            "guest_house_id" => $guest_house_id,
            "room_category_id" => $request->category,
            "price_modifier" => $request->price_modifier,
        ]);

        if (!$res) {
            return back()->with(['icon'=>'error','message'=>'Something is wrong']);
        }
        return redirect()->route('room-category-price')->with(['icon'=>'success','message'=>'Room category price modifier added successfully']);
    }

    public function add() {
        $roomCategories = RoomCategory::all();
        return view('guestHouse.RoomCategoryPrice.add', compact('roomCategories'));
    }

    public function edit($id) {
        $roomCategory = RoomCategoryHasPrice::find($id);
        return view('guestHouse.RoomCategoryPrice.edit', compact('roomCategory'));
    }

    public function update (Request $request) {
        $request->validate([
            'price_modifier' => 'required',
        ]);

        $roomCategory = RoomCategoryHasPrice::find($request->id);

        $isUpdate = $roomCategory->update([
            'price_modifier' => $request->price_modifier,
        ]);

        if ( !$isUpdate ) {
            return back()->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }

        $priceCalculator = new PriceCalculatorController();
        $updateRoom = $priceCalculator->calculateRoomPrice($request->id, "room");

        // dd($updateRoom);

        if ( !$updateRoom ){
            return back()->with(['icon'=> 'error','message' => "Sorry, something went wrong on room's price."]);
        }

        return back()->with(['icon'=>'success', 'message'=>'Room category updated successfully.']);
    }
}
