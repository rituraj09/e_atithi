<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // countries' name (Asian only)
        DB::table('countries')->insert(array(
            array('name' => 'Afghanistan'),
            array('name' => 'Bangladesh'),
            array('name' => 'Bhutan'),
            array('name' => 'India'),
            array('name' => 'Iran'),
            array('name' => 'Maldives'),
            array('name' => 'Nepal'),
            array('name' => 'Pakistan'),
            array('name' => 'Sri Lanka')
        ));

        // states' name
        DB::table('states')->insert(array(
            array('country_id'=>'4', 'name' => 'Andhra Pradesh'),
            array('country_id'=>'4', 'name' => 'Arunachal Pradesh'),
            array('country_id'=>'4', 'name' => 'Assam'),
            array('country_id'=>'4', 'name' => 'Bihar'),
            array('country_id'=>'4', 'name' => 'Chhattisgarh'),
            array('country_id'=>'4', 'name' => 'Goa'),
            array('country_id'=>'4', 'name' => 'Gujarat'),
            array('country_id'=>'4', 'name' => 'Haryana'),
            array('country_id'=>'4', 'name' => 'Himachal Pradesh'),
            array('country_id'=>'4', 'name' => 'Jammu and Kashmir'),
            array('country_id'=>'4', 'name' => 'Jharkhand'),
            array('country_id'=>'4', 'name' => 'Karnataka'),
            array('country_id'=>'4', 'name' => 'Kerala'),
            array('country_id'=>'4', 'name' => 'Madhya Pradesh'),
            array('country_id'=>'4', 'name' => 'Maharashtra'),
            array('country_id'=>'4', 'name' => 'Manipur'),
            array('country_id'=>'4', 'name' => 'Meghalaya'),
            array('country_id'=>'4', 'name' => 'Mizoram'),
            array('country_id'=>'4', 'name' => 'Nagaland'),
            array('country_id'=>'4', 'name' => 'Odisha'),
            array('country_id'=>'4', 'name' => 'Punjab'),
            array('country_id'=>'4', 'name' => 'Rajasthan'),
            array('country_id'=>'4', 'name' => 'Sikkim'),
            array('country_id'=>'4', 'name' => 'Tamil Nadu'),
            array('country_id'=>'4', 'name' => 'Telangana'),
            array('country_id'=>'4', 'name' => 'Tripura'),
            array('country_id'=>'4', 'name' => 'Uttar Pradesh'),
            array('country_id'=>'4', 'name' => 'Uttarakhand'),
            array('country_id'=>'4', 'name' => 'West Bengal'),
        ));

        // distric name

    }
}