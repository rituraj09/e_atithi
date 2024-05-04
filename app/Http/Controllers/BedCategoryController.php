<?php

namespace App\Http\Controllers;

use App\Models\BedCategory;
use Illuminate\Http\Request;
use App\Models\BedHasPriceModifier;
use App\Models\GuestHouseHasEmployee;

class BedCategoryController extends Controller
{
    //
    public function index() {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $bedCategories = BedHasPriceModifier::with('Bed')->where('guest_house_id', $guest_house_id)->get();
        return view('guestHouse.BedCategory.index', compact('bedCategories'));
    }

    public function add() {
        $bedCategories = BedCategory::all();
        return view('guestHouse.BedCategory.add', compact('bedCategories'));
    }

    public function edit($id) {
        dd($id);
        return view('guestHouse.BedCategory.edit');
    }

    public function view($id) {
        dd($id);
        return view('guestHouse.bedCategory.view');
    }

    public function store (Request $request) {

        dd($request->input("price_modifier"));

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $request->validate([
            // "name" => 'required',
            // "occupancy" => 'required',
            "bedType" => 'required',
            "price_modifier" => 'required',
        ]);

        $bedCategory = BedHasPriceModifier::create([
            // "name" => $request->input("name"),
            // "capacity" => $request->input("occupancy"),
            "bed_type" => $request->input("bedType"),
            "price_modifier" => $request->input("price_modifier"),
            "remarks" => $request->input("remarks"),
            "guest_house_id" => $guest_house_id,
        ]);
        dd($request);

        if (!$bedCategory) {
            return back()->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }

        return redirect()->route('bed-categories')->with(['icon'=>'sucess','message'=>'Bed category added successfully']);
    }
}
