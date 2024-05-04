<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BedHasPriceModifier;
use App\Models\RoomCategoryHasPrice;

class PriceCalculatorController extends Controller
{
    //
    public static function calculateRoomPrice($basePrice, $bedCategory, $roomCategory) {
        $bedCategory = BedHasPriceModifier::find($bedCategory);
        $roomCategory = RoomCategoryHasPrice::find($roomCategory);

        $totalPrice = $basePrice + $bedCategory->price_modifier + $roomCategory->price_modifier;

        return $totalPrice;
    }
}
