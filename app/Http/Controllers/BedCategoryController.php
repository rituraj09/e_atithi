<?php

namespace App\Http\Controllers;

use App\Models\BedCategory;
use Illuminate\Http\Request;
use App\Models\GuestHouseHasEmployee;

class BedCategoryController extends Controller
{
    //
    public function index() {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $bedCategories = BedCategory::where('guest_house_id', $guest_house_id)->get();
        return view('guestHouse.BedCategory.index', compact('bedCategories'));
    }

    public function add() {
        return view('guestHouse.BedCategory.add');
    }

    public function edit() {
        return view('guestHouse.BedCategory.edit');
    }

    public function view() {
        return view('guestHouse.bedCategory.view');
    }

    public function store (Request $request) {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $request->validate([
            "name" => 'required',
            "occupancy" => 'required',
            "price_modifier" => 'required',
        ]);

        $bedCategory = BedCategory::create([
            "name" => $request->input("name"),
            "capacity" => $request->input("occupancy"),
            "price_modifier" => $request->input("price_modifier"),
            "remarks" => $request->input("remarks"),
            "guest_house_id" => $guest_house_id,
        ]);

        if (!$bedCategory) {
            return redirect()->route('add-bed-category')->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }

        return redirect()->route('bed-categories')->with(['icon'=>'sucess','message'=>'Bed category added successfully']);
    }
}
