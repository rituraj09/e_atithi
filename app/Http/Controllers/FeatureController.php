<?php

namespace App\Http\Controllers;

use App\Models\RoomFeatures;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    //
    public function allFeatures () {
        $features = RoomFeatures::all();

        return view('guestHouse.Features.index', compact('features'));
    }

    public function addFeature () {
        return view('guestHouse.Features.add');
    }

    public function newFeatures (Request $request) {
        $features = $request->input('features');
        return $features;
    }
}
