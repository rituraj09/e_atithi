<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Guesthouse;
use App\Models\RoomHasBed;
use Illuminate\Http\Request;
use App\Models\BedHasPriceModifier;
use App\Models\RoomCategoryHasPrice;
use App\Models\GuestHouseHasEmployee;

class PriceCalculatorController extends Controller
{
    //
    public function calculateRoomPrice($id, $type) {

        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)
                                                ->pluck('guest_house_id')
                                                ->first();

        $guestHouse = Guesthouse::find($guest_house_id);

        // for bed category price
        if ( $type === "bed" ) {
            $bedCategory = BedHasPriceModifier::find($id);
            $rooms = RoomHasBed::where('bed_type', $bedCategory->id)->get();

            foreach ( $rooms as $room ) {
                $newRoom = Rooms::find($room->room_id);

                // general rate
                $subTotal = $guestHouse->base_price + $bedCategory->price_modifier + $newRoom->roomCategory->price_modifier;
                $newPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );
                $newRoom->update(['total_price' => $newPrice]);

                // govt rate
                $subTotal = $guestHouse->govt_base_price + $bedCategory->price_modifier + $newRoom->roomCategory->price_modifier;
                $newPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );
                $newRoom->update(['total_govt_price' => $newPrice]);
            }
        // for room category
        } else if ( $type === 'room' ) {
            $roomCategory = RoomCategoryHasPrice::find($id);
            $rooms = Rooms::where('guest_house_id', $guest_house_id)
                            ->where('room_category', $id)
                            ->get();

            foreach ( $rooms as $room ) {
                $bed = RoomHasBed::where('room_id', $room->id)->first();
                $bedHasPrice = BedHasPriceModifier::find($bed->bed_type); //$bedHasPrice->price_modifier

                // general rate
                $subTotal = $guestHouse->base_price + $bedHasPrice->price_modifier + $roomCategory->price_modifier;
                $newPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );
                $newRoom->update(['total_price' => $newPrice]);

                // govt rate
                $subTotal = $guestHouse->govt_base_price + $bedHasPrice->price_modifier + $roomCategory->price_modifier;
                $newPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );
                $newRoom->update(['total_govt_price' => $newPrice]);
            }
        }
        return true;
    }

    public function recalculateAll() {
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)
                                                ->pluck('guest_house_id')->first();
        $guestHouse = Guesthouse::find($guest_house_id);

        $rooms = Rooms::where('guest_house_id', $guest_house_id)->get();

        foreach ($rooms as $room) {
            // room category
            // $category = $room->room_category;
            $roomCategory = RoomCategoryHasPrice::find($room->room_category);

            // bed category
            $bed = RoomHasBed::where('room_id', $room->id)->first();
            $bedHasPrice = BedHasPriceModifier::find($bed->bed_type);

            // general rate
            $subTotal = $guestHouse->base_price + $bedHasPrice->price_modifier + $roomCategory->price_modifier;
            $newPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );
            $room->update(['total_price' => $newPrice]);

            // govt rate
            $subTotal = $guestHouse->govt_base_price + $bedHasPrice->price_modifier + $roomCategory->price_modifier;
            $newPrice = $subTotal + (($subTotal * $guestHouse->sgst)/100 ) + (($subTotal * $guestHouse->sgst)/100 );
            $room->update(['total_govt_price' => $newPrice]);
        }
    }
}
