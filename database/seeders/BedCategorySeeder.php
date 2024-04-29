<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BedCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('bed_categories')->insert(array(
            array('name' => 'Single bed','capacity'=>1),
            array('name' => 'Double bed','capacity'=>2),
            array('name' => 'Queen bed','capacity'=>2),
            array('name' => 'King bed','capacity'=>2),
            array('name' => 'Bunk bed','capacity'=>2),
            array('name' => 'Sofa bed','capacity'=>2),
        ));
    }
}
