<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('room_statuses')->insert(array(
            array('name' => 'Vacant'),
            array('name' => 'Occupied'),
            array('name' => 'Maintenance'),
            array('name' => 'Reserve'),
        ));
    }
}
