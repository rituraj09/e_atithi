<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservationReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('reservation_reasons')->insert(array(
            array('reason_name' => 'Official Travel & Stay'),      
            array('reason_name' => 'VIP Stays'),
            array('reason_name' => 'Dignitary Accommodation'),
            array('reason_name' => 'Holidays & Vacations'),      
            array('reason_name' => 'Business Trips'),
            array('reason_name' => 'Family Gatherings'),
        ));
    }
}