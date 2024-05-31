<?php

namespace App\Http\Controllers;

use App\Models\AdminLogs;
use App\Models\GuestsLogs;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //
    public function guestLog($ip = null, $activity = null){
        // auto ip, auto time
        // custom activity, variable user id
        $guestId = auth()->guard('web')->user()->id;
        $data = [
            'ip_address' => $ip,
            'activity' => $activity,
            'guest_id' => $guestId,
        ];

        $logs = GuestsLogs::create($data);

        return $logs;
    }

    public function adminLog($ip = null, $activity = null){
        // auto ip, auto time
        // custom activity, variable user id
        $adminId = auth()->guard('web')->user()->id;
        
        $data = [
            'ip_address' => $ip,
            'activity' => $activity,
            'admin_id' => $adminId,
            'admin_role' => auth()->guard('web')->user()->roles[0]->name,
        ];

        $logs = AdminLogs::create($data);

        return $logs;
    }
}
