<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('reservation_statuses')->insert(array(
            array('name' => 'Reservation done'),
            array('name' => 'Reservation cancelled by guest'),
            array('name' => 'Reservation approved'),
            array('name' => 'Reservation rejected'),
            array('name' => 'Guest Check in process'),
            array('name' => 'Guest Checked in completed'),
            array('name' => 'Guest Check Out in process'),
            array('name' => 'Guest Check Out completed'),
            array('name' => 'Bill Generated'),
            array('name' => 'Receipt Generated'),
            array('name' => 'Guest Did not stayed'),
            array('name' => 'Reservation approved but cancelled by User'),
            array('name' => 'Reservation approved but cancelled by Admin'),
            array('name' => 'Accommodation cancelled by Admin'),
        ));
    }
}
