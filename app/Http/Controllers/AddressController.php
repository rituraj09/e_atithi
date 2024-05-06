<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Districts;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    public function getStates($cid) {
        $states = State::where('country_id', $cid)->get();
        return response()->json($states);
    }

    public function getDistricts($sid) {
        $states = Districts::where('state_id', $sid)->get();
        return response()->json($states);
    }
}
