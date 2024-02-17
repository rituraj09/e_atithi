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
            array('name' => 'circuit house', 'created_at' => '2024-02-02'),
            array('name' => 'others', 'created_at' => '2024-02-03'),
        ));

        // DB::table('guesthouses')
    }
}
