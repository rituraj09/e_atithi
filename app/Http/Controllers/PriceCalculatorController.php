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

                $newPrice = $guestHouse->base_price + $bedCategory->price_modifier + $newRoom->roomCategory->price_modifier;

                $newRoom->update(['total_price' => $newPrice]);
            }
        // for room category
        } else if ( $type === 'room' ) {
            $roomCategory = RoomCategoryHasPrice::find($id);
            $rooms = Rooms::where('guest_house_id', $guest_house_id)
                            ->where('room_category', $id)
                            ->get();

            foreach ( $rooms as $room ) {
                $beds = RoomHasBed::where('room_id', $room->id)->first();
                $bedHasPrice = BedHasPriceModifier::find($beds->bed_type); //$bedHasPrice->price_modifier

                $newPrice = $guestHouse->base_price + $bedHasPrice->price_modifier + $roomCategory->price_modifier;

                $room->update(['total_price' => $newPrice]);
            }
        }
        return true;
    }
}
