<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IdCardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('id_card_types')->insert(array(
            array('name' => 'Aadhar card'),
            array('name' => 'Employee Id card'),
            array('name' => 'PAN card'),
            array('name' => 'Voter card'),
            array('name' => 'Others'),
        ));
    }
}
