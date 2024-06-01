<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rooms;
use App\Models\Feature;
use App\Models\RateList;
use App\Models\Guesthouse;
use App\Models\RoomHasBed;
use App\Models\BedCategory;
use App\Models\RoomOnDates;
use App\Models\RoomCategory;
use App\Models\RoomFeatures;
use Illuminate\Http\Request;
use App\Models\BedHasPriceModifier;
use App\Models\RoomCategoryHasPrice;
use App\Models\GuestHouseHasEmployee;
// use App\Http\Controllers\PriceCalculatorController;

class RoomController extends Controller
{
    //
    public function getRoom () {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        
        $rooms = Rooms::with(['roomCategory','bedType'])
                        // ->pluck('')
                        ->where('guest_house_id', $guest_house_id)
                        ->get();

        return view('guestHouse.Rooms.index', compact('rooms'));
    }

    public function addRoomView() {
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        if(!$guest_house_id) {
            return response()->json('no');
        }
        $roomCategories = RoomCategoryHasPrice::where('guest_house_id', $guest_house_id)->get();

        $bedCategories = BedHasPriceModifier::where('guest_house_id', $guest_house_id)->get();

        if (!$roomCategories) {
            return view('guestHouse.Rooms.addRoom');
        }

        $guestHouse = Guesthouse::select('base_price','govt_base_price')->find($guest_house_id);

        // dd($guestHouse);
        // echo $roomCategories;

        return view('guestHouse.Rooms.addRoom', compact(['roomCategories','bedCategories', 'guestHouse']));
    }

    public function getAllRooms () {
        $rooms = Rooms::all();

        if (!$rooms) {
            return view('guestHouse.Rooms.index');
        }

        return view('guestHouse.Rooms.index', ['rooms' => $rooms]);
    }

    public function addRoom (Request $request) {
        // dd($request);

        $this->validateForm($request);
        // dd($request);

        $employeeId = auth()->guard('web')->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $guestHouse = Guesthouse::select('base_price','govt_base_price','sgst','cgst')->find($guest_house_id);
        $bedCategory = BedHasPriceModifier::find($request->bedCategory);
        $roomCategory = RoomCategoryHasPrice::find($request->roomCategory);

        // for general
        $subTotal = $guestHouse->base_price + $bedCategory->price_modifier + $roomCategory->price_modifier;
        $totalPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );

        // for govt
        $subTotal = $guestHouse->govt_base_price + $bedCategory->price_modifier + $roomCategory->price_modifier;
        $totalGovtPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );

        $capacity = $bedCategory->capacity * $request->numberOfBeds;

        $room = Rooms::create([
            'room_number' => $request->roomNumber,
            'guest_house_id' => $guest_house_id,
            'bed_type' => $request->bedCategory,
            'room_category' => $request->roomCategory,
            'no_of_beds' => $request->numberOfBeds,
            'capacity' => $request->capacity || $capacity,
            'total_price' => $totalPrice,
            'total_govt_price' => $totalGovtPrice,
            'width' => $request->width || null,
            'length' => $request->length || null,
        ]);

        $roomHasBed = RoomHasBed::create([
            'room_id' => $room->id,
            'bed_type' => $request->bedCategory,
        ]);

        if (!$room) {
            return back()->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }

        return redirect()->route('guest-house-admin-rooms')->with(['icon'=>'success','message'=>'Room added successfull']);
    }

    public function editRoom ($id) {
        $room = Rooms::with(['bedType','roomCategory'])->find($id);

        $employeeId = auth()->guard('web')->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        $guestHouse = Guesthouse::find($guest_house_id);
        $roomCategories = RoomCategoryHasPrice::where('guest_house_id', $guest_house_id)->get();
        $bedCategories = BedHasPriceModifier::where('guest_house_id', $guest_house_id)->get();
        
        // $roomRates = RateList::with('roomCategory')
        //                     ->where('guest_house_id', $guest_house_id)
        //                     ->get();

        // dd($room);

        if (!$room) {
            return view('guestHouse.Rooms.editRoom');
        }
        return view('guestHouse.Rooms.editRoom', compact(['guestHouse','room', 'roomCategories', 'bedCategories']));
    }

    public function updateRoom (Request $request) {
        $room = Rooms::find($request->id)->first();
        $this->validateForm($request);

        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)->pluck('guest_house_id')->first();
        $guestHouse = Guesthouse::select('base_price','govt_base_price','sgst','cgst')->find($guest_house_id);
        $bedCategory = BedCategory::find($request->bedCategory);
        $roomCategory = RoomCategory::find($request->roomCategory);

        // for general
        $subTotal = $guestHouse->govt_base_price + $bedCategory->price_modifier + $roomCategory->price_modifier;
        $totalPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );

        // for govt
        $subTotal = $guestHouse->govt_base_price + $bedCategory->price_modifier + $roomCategory->price_modifier;
        $totalGovtPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );

        $fields = [
            'room_number' => $request->roomNumber,
            // 'room_rate' => $request->roomCategory,
            'bed_type' => $request->bedCategory,
            'room_category' => $request->roomCategory,
            // 'base_price' => $request->basePrice,
            'total_price' => $totalPrice,
            'total_govt_price' => $totalGovtPrice,
            'no_of_beds' => $request->numberOfBeds,
            'capacity' => $request->capacity,
            'width' => $request->width || null,
            'length' => $request->length || null,
        ];

        $isRoom = $room->update($fields);

        if (!$isRoom) {
            return redirect()->route('guest-house-edit-room', ['id' => $request->id])
                        ->with(['icon'=>'error', 'message' => 'Room details not updating']);
        }

        return redirect()->route('guest-house-admin-rooms')
                        ->with(['icon'=>'success', 'message'=>'Room details updated successfully']);
    }

    public function viewRoom($id) {
        $room = Rooms::where('id', $id)
                    ->first();

        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();
        $roomCategories = RoomCategory::where('guest_house_id', $guest_house_id)->get();
        
        $roomRates = RateList::with('roomCategory')
                            ->where('guest_house_id', $guest_house_id)
                            ->get();

        $features = RoomFeatures::where('room_id', $room->id)
                                ->get();

        
        $fetchedDates = RoomOnDates::select('date')->where('room_id', $id)->get();

        $bookedDates = $fetchedDates->map(function($fetchedDate) {
            return Carbon::parse($fetchedDate->date)->format('d/m/Y');
        });

        // dd($bookedDates);
        if (!$room) {
            return view('guestHouse.Rooms.viewRoom');
        }   
        return view('guestHouse.Rooms.viewRoom', compact(['room','roomRates', 'roomCategories', 'features', 'bookedDates']));
    }

    public function validateForm ($request) {
        return $request->validate([
            'roomNumber' => 'required|unique:rooms,room_number',
            'numberOfBeds' => 'required',
            'roomCategory' => 'required',
            'bedCategory' => 'required',
        ],[
            'roomNumber.required' => 'Please enter a room number',
            'roomNumber.unique' => 'Please enter a unique room number.',
            'numberOfBeds.required' => 'Please enter number of beds.',
            'roomCategory.required' => 'Please select a room category',
            'bedCategory.required' => 'Please select a bed category.',
        ]);
    }
}
