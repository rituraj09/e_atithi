<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\RoomCategoryFeature;
use App\Models\RoomCategoryHasPrice;
use App\Models\GuestHouseHasEmployee;

class RoomCategoryFeatureController extends Controller
{
    //
    public function roomFeatures($id) {
        $roomCategory = RoomCategoryHasPrice::find($id);
        $features = Feature::all();
        // $roomFeatues = [];
        // $roomFeature = RoomCategoryFeature::where('room_id', $request->roomId)
        //                         ->where('feature_id', $request->featureId)
        //                         ->first();

        $roomFeatures = RoomCategoryFeature::where('room_category_id', $id)
                                    ->where('is_active',1)      //if already added but not active
                                    ->pluck('feature_id')
                                    ->toArray();

        // dd($roomFeatues);

        return view('guestHouse.RoomCategoryPrice.roomCategoryFeatures', compact(['roomCategory', 'features', 'roomFeatures']));
    }

    // ajax
    public function addRoomFeature (Request $request) {
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)->pluck('guest_house_id')->first();
        
        $roomFeature = RoomCategoryFeature::where('room_category_id', $request->roomCategoryId)
                                ->where('feature_id', $request->featureId)
                                ->first();

        if ($roomFeature) {
            $isAdded = $roomFeature->update([
                'is_active' => 1,
            ]);
        } else {
            $isAdded = RoomCategoryFeature::create([
                'room_category_id' => $request->roomCategoryId,
                'guest_house_id' => $guest_house_id,
                'feature_id' => $request->featureId,
                'is_active' => 1,
                'created_by' => auth()->guard('web')->user()->id,
            ]);
        }

        if(!$isAdded) {
            return "failed";
        }

        return "done";
    }

    public function removeRoomFeature (Request $request) {
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)->pluck('guest_house_id')->first();
        
        $roomFeature = RoomCategoryFeature::where('room_category_id', $request->roomCategoryId)
                                ->where('feature_id', $request->featureId)
                                ->first();

        if ($roomFeature) {
            $isRemoved = $roomFeature->update([
                'is_active' => 0,
            ]);
            
            if(!$isRemoved) {
                return "failed";
            }

            return "done";
        } else {
            return "failed";
        }
    }
}
