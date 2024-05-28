<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\GuestHouseHasEmployee;

class FeatureController extends Controller
{
    //
    public function allFeatures () {
        $employeeId = auth()->guard('web')->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $features = Feature::where('guest_house_id', $guest_house_id)->get();

        return view('guestHouse.Features.index', compact('features'));
    }

    public function addFeature () {
        return view('guestHouse.Features.add');
    }

    public function newFeatures (Request $request) {

        // dd($request);
        // $features = $request->input('features');
        $employeeId = auth()->guard('web')->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        // dd(count($request->features));
        // for ( $i = 0; $i < count($request->features); $i++) {
        //     // dd($feature);
        //     $feature = $request->features[$i];
        //     // dd($feature);
        //     $feature->validate([
        //         'name' => 'required|min:2',
        //     ]);
        // }

        // for ( $i = 0; $i < count($request->features); $i++) {
        //     $feature = $request->features[$i];
        $this->validateFields($request);

        $isFeature = Feature::create([
            'name' => $request->name,
            'description' => $request->description,
            // 'price' => $request->price,
            'remarks' => $request->remarks,
            'guest_house_id' => $guest_house_id,
        ]);

        if (!$isFeature) {
            return back()->with(['icon'=>'error', 'message'=>'Something went wrong']);
        }

        return redirect()->route('guest-house-room-features')
                        ->with(['icon'=>'success', 'message'=>'Features are added successfully']);
    }

    public function editFeature($id) {
        $feature = Feature::find($id);
        return view('guestHouse.Features.edit', compact('feature'));
    }

    public function updateFeature(Request $request) {
        $this->validateFields($request);

        $feature = Feature::find($request->id);

        $isUpdate = $feature->update([
            'name' => $request->name,
            'description' => $request->description,
            // 'price' => $request->price,
            'remarks' => $request->remarks,
        ]);

        if(!$isUpdate) {
            return back()->with(['icon' => 'failed', 'message' => 'Something went wrong!']);
        }   
        return redirect()->route('guest-house-room-features')->with(['icon' => 'success', 'message' => 'Feature details updated successfully']);
    }

    public function validateFields($request) {
        return $request->validate([
            'name' => 'required',
            // 'price' => 'required',
        ],[
            'name.required' => 'Please enter the feature name',
            // 'price.required' => "Please enter a price, ('zero' or 0 for free)",
        ]);
    }
}
