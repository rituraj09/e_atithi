<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // countries' names (Asian only)
        DB::table('countries')->insert(array(
            array('names' => 'Afghanistan'),
            array('names' => 'Bangladesh'),
            array('names' => 'Bhutan'),
            array('names' => 'India'),
            array('names' => 'Iran'),
            array('names' => 'Maldives'),
            array('names' => 'Nepal'),
            array('names' => 'Pakistan'),
            array('names' => 'Sri Lanka')
        ));

        // states' names
        DB::table('states')->insert(array(
            array('country_id'=>'4', 'names' => 'Andhra Pradesh'),
            array('country_id'=>'4', 'names' => 'Arunachal Pradesh'),
            array('country_id'=>'4', 'names' => 'Assam'),
            array('country_id'=>'4', 'names' => 'Bihar'),
            array('country_id'=>'4', 'names' => 'Chhattisgarh'),
            array('country_id'=>'4', 'names' => 'Goa'),
            array('country_id'=>'4', 'names' => 'Gujarat'),
            array('country_id'=>'4', 'names' => 'Haryana'),
            array('country_id'=>'4', 'names' => 'Himachal Pradesh'),
            array('country_id'=>'4', 'names' => 'Jammu and Kashmir'),
            array('country_id'=>'4', 'names' => 'Jharkhand'),
            array('country_id'=>'4', 'names' => 'Karnataka'),
            array('country_id'=>'4', 'names' => 'Kerala'),
            array('country_id'=>'4', 'names' => 'Madhya Pradesh'),
            array('country_id'=>'4', 'names' => 'Maharashtra'),
            array('country_id'=>'4', 'names' => 'Manipur'),
            array('country_id'=>'4', 'names' => 'Meghalaya'),
            array('country_id'=>'4', 'names' => 'Mizoram'),
            array('country_id'=>'4', 'names' => 'Nagaland'),
            array('country_id'=>'4', 'names' => 'Odisha'),
            array('country_id'=>'4', 'names' => 'Punjab'),
            array('country_id'=>'4', 'names' => 'Rajasthan'),
            array('country_id'=>'4', 'names' => 'Sikkim'),
            array('country_id'=>'4', 'names' => 'Tamil Nadu'),
            array('country_id'=>'4', 'names' => 'Telangana'),
            array('country_id'=>'4', 'names' => 'Tripura'),
            array('country_id'=>'4', 'names' => 'Uttar Pradesh'),
            array('country_id'=>'4', 'names' => 'Uttarakhand'),
            array('country_id'=>'4', 'names' => 'West Bengal'),
        ));

        // distric names

    }
}