<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('room_categories')->insert(array(
            array('name' => 'Standard Room'),
            array('name' => 'Business Room'),
            array('name' => 'Deluxe Room'),
            array('name' => 'VIP Room'),
        ));
    }
}
