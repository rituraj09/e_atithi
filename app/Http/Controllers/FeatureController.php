<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\GuestHouseHasEmployee;

class FeatureController extends Controller
{
    //
    public function allFeatures () {
        $features = Feature::all();

        return view('guestHouse.Features.index', compact('features'));
    }

    public function addFeature () {
        return view('guestHouse.Features.add');
    }

    public function newFeatures (Request $request) {
        // $features = $request->input('features');
        $employeeId = auth()->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();


        // dd(count($request->features));
        for ( $i = 0; $i < count($request->features); $i++) {
            // dd($feature);
            $feature = $request->features[$i];
            // dd($feature);
            $feature->validate([
                'name' => 'required|min:2',
            ]);
        }

        for ( $i = 0; $i < count($request->features); $i++) {
            $feature = $request->features[$i];
            $isFeature = Feature::create([
                'name' => $feature->name,
                'description' => $feature->description,
                'price' => $feature->price,
                'remarks' => $feature->remarks,
                'guest_house_id' => $guest_house_id,
            ]);

            if (!$isFeature) {
                return redirect()->route('add-guest-house-room-features')
                                ->with(['icon'=>'error', 'message'=>'Something went wrong']);
            }
        }

        return redirect()->route('guest-house-room-features')
                        ->with(['icon'=>'success', 'message'=>'Features are added successfully']);
    }
}
