<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('room_statuses')->insert(array(
            array('name' => 'Active'),      
            array('name' => 'Maintenance'),
            array('name' => 'Blocked'),
        ));
    }
}
