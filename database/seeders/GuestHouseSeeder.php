<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuestHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('guest_house_types')->insert(array(
            array('name' => 'circuit house'),
            array('name' => 'others'),
        ));

        // DB::table('guesthouses')
    }
}
