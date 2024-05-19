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
        // dd($id);
        $bedCategory = BedHasPriceModifier::find($id);
        return view('guestHouse.BedCategory.edit', compact('bedCategory'));
    }

    public function view($id) {
        // dd($id);
        $bedCategory = BedHasPriceModifier::find($id);
        return view('guestHouse.BedCategory.view', compact('bedCategory'));
    }

    public function store (Request $request) {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $request->validate([
            "bedType" => 'required',
            "price_modifier" => 'required',
        ]);

        $bedCategory = BedHasPriceModifier::create([
            "bed_type" => $request->input("bedType"),
            "price_modifier" => $request->input("price_modifier"),
            "remarks" => $request->input("remarks"),
            "guest_house_id" => $guest_house_id,
        ]);

        if (!$bedCategory) {
            return back()->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }

        return redirect()->route('bed-categories')->with(['icon'=>'sucess','message'=>'Bed category added successfully']);
    }

    public function update (Request $request) {
        $request->validate([
            "price_modifier" => 'required',
        ]);

        $bedCategory = BedHasPriceModifier::find($request->id);

        $oldPrice = $bedCategory->price_modifier;
        $newPrice = $request->price_modifier;

        $isUpdate = $bedCategory->update([
            'price_modifier' => $request->price_modifier,
            'remarks' => $request->remarks,
        ]);

        if ( $oldPrice !== $newPrice ) {
            $priceCalculator = new PriceCalculatorController();
            $updateRooms = $priceCalculator->calculateRoomPrice( $request->id, "bed");
        }

        // dd($updateRooms);


        if ( !$isUpdate ){
            return back()->with(['icon'=> 'error','message' => 'Sorry, something went wrong.']);
        }

        return back()->with(['icon'=> 'success','message' => 'Price changed successfully.']);
    }
}
