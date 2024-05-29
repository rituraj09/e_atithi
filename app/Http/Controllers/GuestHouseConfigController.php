<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use App\Models\Districts;
use App\Models\Guesthouse;
use Illuminate\Http\Request;
use App\Models\GuestCategories;
use App\Models\GuestHouseImage;
use App\Models\GuestHouseHasEmployee;

class GuestHouseConfigController extends Controller
{
    //
    public function index() {
        $employeeId = auth()->guard('web')->user()->id;
        $guest_house_id = GuestHouseHasEmployee::where('employee_id', $employeeId)->pluck('guest_house_id')->first();

        $guestHouse = Guesthouse::find($guest_house_id);

        $guestHouseImages = GuestHouseImage::where('guest_house_id', $guest_house_id)->get();
        // dd($guestHouseImages);

        $countries = Country::all();
        $states = State::where('country_id', $guestHouse->country)->get();
        $districts = Districts::where('state_id', $guestHouse->state)->get();

        return view('guestHouse.guestHouseConfig.index', compact(['countries', 'states', 'districts', 'guestHouse', 'guestHouseImages']));
    }

    public function update(Request $request) {

        // return $request;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'district' => 'required',
            'PIN' => 'required',
            'guest_type' => 'required',
            'payment_type' => 'required',
            'base_price' => 'required',
            'cgst' => 'required',
            'sgst' => 'required',
            'govt_base_price' => 'required',
        ], [
            'name.required' => 'Please enter a guest house name.',
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter a contact phone number.',
            'country.required' => 'Please select a country.',
            'state.required' => 'Please select a state.',
            'district.required' => 'Please select a district.',
            'PIN.required' => 'Please enter a PIN code.',
            'guest_type.required' => 'Please select a guest type.',
            'payment_type.required' => 'Please select a payment type.',
            'base_price.required' => 'Please enter a base price for all rooms.',
            'cgst.required' => 'Please enter a central GST tax in percentage.',
            'sgst.required' => 'Please enter a state GST tax in percentage.',
            'govt_base_price.required' => 'Please enter a base price for govt employee.',
        ]);

        $guestHouse = Guesthouse::find($request->guestHouse_id);

        $isUpdate = $guestHouse->update([
            'name' => $request->name,
            'official_email' => $request->email,
            'contact_no' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'district' => $request->district,
            'pin' => $request->PIN,
            'guest_type' => $request->guest_type,
            'payment_type' => $request->payment_type,
            'base_price' => $request->base_price,
            'cgst' => $request->cgst,
            'sgst' => $request->sgst,
            'govt_base_price' => $request->govt_base_price,
        ]);

        // GuestHouseImages::find(1);
        $this->uploadImage($request);

        if (!$isUpdate) {
            return back()->with(['icon' => 'error', 'message' => 'Something is wrong']);
        }
        // return $isUpdate;
        return back()->with(['icon' => 'success', 'message' => 'Guest house config is updated successfully.']);
        
    }

    private function uploadImage( $request){
        $guestHouseId = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)
            ->pluck('guest_house_id')
            ->first();

        // Retrieve uploaded images (assuming single file for thumbnail and separate for others)
        $thumbnailImage = $request->file('thumb');
        $otherImages = [
            $request->file('img1'),
            $request->file('img2'),
            $request->file('img3'),
        ];

        // Update or create thumbnail image
        $thumbnail = GuestHouseImage::where('guest_house_id', $guestHouseId)
            ->where('is_thumb', 1)
            ->first();

        if ($thumbnail) {
            // Update existing thumbnail
            $thumbnailName = null;
            if ($thumbnailImage) {
                $thumbnailName = time() . '.' . $thumbnailImage->getClientOriginalExtension();
                $thumbnailPath = $thumbnailImage->storeAs('public/images', $thumbnailName);
                $thumbnail->update([
                    'image' => $thumbnailName,
                ]);
            }
        } else {
            // Create a new thumbnail if it doesn't exist
            $thumbnailName = time() . '.' . $thumbnailImage->getClientOriginalExtension();
            $thumbnailPath = $thumbnailImage->storeAs('public/images', $thumbnailName);
            GuestHouseImage::create([
                'guest_house_id' => $guestHouseId,
                'image' => $thumbnailName,
                'is_thumb' => 1,
            ]);
        }

        // Handle other images (up to 3)
        $existingOtherImages = GuestHouseImage::where('guest_house_id', $guestHouseId)
            ->where('is_thumb', 0)
            ->get();

        $numNewImages = min(count(array_filter($otherImages)), 3 - count($existingOtherImages)); // Limit to 3 new images

        // Prepare image data for updates (if any)
        $imagesToUpdate = [];
        for ($i = 0; $i < count($otherImages); $i++) {
            if ($otherImages[$i] !== null) {
                $imageName = time() . $i . '.' . $otherImages[$i]->getClientOriginalExtension();
                $imagePath = $otherImages[$i]->storeAs('public/images', $imageName);
                $imagesToUpdate[] = [
                    'id' => isset($existingOtherImages[$i]) ? $existingOtherImages[$i]->id : null, // Use existing ID if available
                    'image' => $imageName,
                ];
            }
        }

        // Update existing non-thumbnail images (if any)
        if ($imagesToUpdate) {
            foreach ($imagesToUpdate as $data) {
                GuestHouseImage::where('id', $data['id'])->update($data);
            }
        }

        // Create new non-thumbnail images (if any)
        if ($numNewImages > 0) {
            for ($i = 0; $i < $numNewImages; $i++) {
                if ($otherImages[$i] !== null) {
                    $image = $otherImages[$i];
                    $imageName = time() . $i . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('public/images', $imageName);
                    GuestHouseImage::create([
                        'guest_house_id' => $guestHouseId,
                        'image' => $imageName,
                        'is_thumb' => 0,
                    ]);
                }
            }
        }

        // Handle success or error scenarios (e.g., redirect, flash messages)
    }


    public function upload2Image($request) {

        $guest_house_id = GuestHouseHasEmployee::where('employee_id', auth()->guard('web')->user()->id)
                                                ->pluck('guest_house_id')
                                                ->first();

        $thumbnail = GuestHouseImage::where('guest_house_id', $guest_house_id)->where('is_thumb', 1)->first();

        $thumbnailImage = $request->file('thumb');
        $thumbnailName = null;
        if ($thumbnailImage) {
            $thumbnailName = time() . '.' . $thumbnailImage->getClientOriginalExtension();
            $thumbnailPath = $thumbnailImage->storeAs('public/images', $thumbnailName);
        }

        $thumbnail->update([
            'image' => $thumbnailPath,
        ]);

        $otherImages = GuestHouseImage::where('guest_house_id', $guest_house_id)->where('is_thumb', 0)->get();

        if ($otherImages) {
            //update
        } else {
            GuestHouseImage::create([
                'image' => $imagePath,
                'is_thumb' => 0,
            ]);
        }

    }
}
