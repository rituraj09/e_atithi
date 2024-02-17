<?php

namespace App\Http\Controllers;

use App\Models\States;
use App\Models\Districts;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    public function getStates($cid) {
        $states = States::where('country_id', $cid)->get();
        return response()->json($states);
    }

    public function getDistricts($sid) {
        $states = Districts::where('state_id', $sid)->get();
        return response()->json($states);
    }
}
