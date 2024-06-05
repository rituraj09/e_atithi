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
            array('name' => 'India', 'country_code'=>'IN'),
        ));

        // states' name
        DB::table('states')->insert(array(
            array('country_id' => '1', 'name' => 'Andaman and Nicobar Islands', 'state_code' => 'AN'),
            array('country_id' => '1', 'name' => 'Andhra Pradesh', 'state_code' => 'AP'),
            array('country_id' => '1', 'name' => 'Arunachal Pradesh', 'state_code' => 'AR'),
            array('country_id' => '1', 'name' => 'Assam', 'state_code' => 'AS'),
            array('country_id' => '1', 'name' => 'Bihar', 'state_code' => 'BR'),
            array('country_id' => '1', 'name' => 'Chandigarh', 'state_code' => 'CH'),
            array('country_id' => '1', 'name' => 'Chhattisgarh', 'state_code' => 'CG'),
            array('country_id' => '1', 'name' => 'Dadra and Nagar Haveli and Daman and Diu', 'state_code' => 'DD'),
            array('country_id' => '1', 'name' => 'Delhi', 'state_code' => 'DL'),
            array('country_id' => '1', 'name' => 'Goa', 'state_code' => 'GA'),
            array('country_id' => '1', 'name' => 'Gujarat', 'state_code' => 'GJ'),
            array('country_id' => '1', 'name' => 'Haryana', 'state_code' => 'HR'),
            array('country_id' => '1', 'name' => 'Himachal Pradesh', 'state_code' => 'HP'),
            array('country_id' => '1', 'name' => 'Jammu and Kashmir', 'state_code' => 'JK'),
            array('country_id' => '1', 'name' => 'Jharkhand', 'state_code' => 'JH'),
            array('country_id' => '1', 'name' => 'Karnataka', 'state_code' => 'KA'),
            array('country_id' => '1', 'name' => 'Kerala', 'state_code' => 'KL'),
            array('country_id' => '1', 'name' => 'Ladakh', 'state_code' => 'LA'),
            array('country_id' => '1', 'name' => 'Lakshadweep', 'state_code' => 'LD'),
            array('country_id' => '1', 'name' => 'Madhya Pradesh', 'state_code' => 'MP'),
            array('country_id' => '1', 'name' => 'Maharashtra', 'state_code' => 'MH'),
            array('country_id' => '1', 'name' => 'Manipur', 'state_code' => 'MN'),
            array('country_id' => '1', 'name' => 'Meghalaya', 'state_code' => 'ML'),
            array('country_id' => '1', 'name' => 'Mizoram', 'state_code' => 'MZ'),
            array('country_id' => '1', 'name' => 'Nagaland', 'state_code' => 'NL'),
            array('country_id' => '1', 'name' => 'Odisha', 'state_code' => 'OR'),
            array('country_id' => '1', 'name' => 'Puducherry', 'state_code' => 'PY'),
            array('country_id' => '1', 'name' => 'Punjab', 'state_code' => 'PB'),
            array('country_id' => '1', 'name' => 'Rajasthan', 'state_code' => 'RJ'),
            array('country_id' => '1', 'name' => 'Sikkim', 'state_code' => 'SK'),
            array('country_id' => '1', 'name' => 'Tamil Nadu', 'state_code' => 'TN'),
            array('country_id' => '1', 'name' => 'Telangana', 'state_code' => 'TG'),
            array('country_id' => '1', 'name' => 'Tripura', 'state_code' => 'TR'),
            array('country_id' => '1', 'name' => 'Uttar Pradesh', 'state_code' => 'UP'),
            array('country_id' => '1', 'name' => 'Uttarakhand', 'state_code' => 'UT'),
            array('country_id' => '1', 'name' => 'West Bengal', 'state_code' => 'WB'),
        ));


        // distric name
        DB::table('districts')->insert(array(
            array('state_id' => '4', 'name' => 'Barpeta', 'district_code' => 'BRP'),
            array('state_id' => '4', 'name' => 'Bongaigaon', 'district_code' => 'BGN'),
            array('state_id' => '4', 'name' => 'Cachar', 'district_code' => 'CCH'),
            array('state_id' => '4', 'name' => 'Darrang', 'district_code' => 'DRG'),
            array('state_id' => '4', 'name' => 'Dhemaji', 'district_code' => 'DMJ'),
            array('state_id' => '4', 'name' => 'Dhubri', 'district_code' => 'DHB'),
            array('state_id' => '4', 'name' => 'Dibrugarh', 'district_code' => 'DBR'),
            array('state_id' => '4', 'name' => 'Goalpara', 'district_code' => 'GLP'),
            array('state_id' => '4', 'name' => 'Golaghat', 'district_code' => 'GLG'),
            array('state_id' => '4', 'name' => 'Hailakandi', 'district_code' => 'HKD'),
            array('state_id' => '4', 'name' => 'Jorhat', 'district_code' => 'JRH'),
            array('state_id' => '4', 'name' => 'Kamrup', 'district_code' => 'KMP'),
            array('state_id' => '4', 'name' => 'Karbi Anglong', 'district_code' => 'KBA'),
            array('state_id' => '4', 'name' => 'Karimganj', 'district_code' => 'KMG'),
            array('state_id' => '4', 'name' => 'Kokrajhar', 'district_code' => 'KKJ'),
            array('state_id' => '4', 'name' => 'Lakhimpur', 'district_code' => 'LKP'),
            array('state_id' => '4', 'name' => 'Morigaon', 'district_code' => 'MGN'),
            array('state_id' => '4', 'name' => 'Nagaon', 'district_code' => 'NGN'),
            array('state_id' => '4', 'name' => 'Nalbari', 'district_code' => 'NBR'),
            array('state_id' => '4', 'name' => 'Sivasagar', 'district_code' => 'SVS'),
            array('state_id' => '4', 'name' => 'Sonitpur', 'district_code' => 'SNP'),
            array('state_id' => '4', 'name' => 'Tinsukia', 'district_code' => 'TSK'),
            array('state_id' => '4', 'name' => 'Udalguri', 'district_code' => 'UDL'),

            array('state_id' => '23', 'name' => 'East Garo Hills', 'district_code' => 'EGH'),
            array('state_id' => '23', 'name' => 'East Jaintia Hills', 'district_code' => 'EJH'),
            array('state_id' => '23', 'name' => 'East Khasi Hills', 'district_code' => 'EKH'),
            array('state_id' => '23', 'name' => 'North Garo Hills', 'district_code' => 'NGH'),
            array('state_id' => '23', 'name' => 'Ri-Bhoi', 'district_code' => 'RBO'),
            array('state_id' => '23', 'name' => 'South Garo Hills', 'district_code' => 'SGH'),
            array('state_id' => '23', 'name' => 'South West Garo Hills', 'district_code' => 'SWGH'),
            array('state_id' => '23', 'name' => 'South West Khasi Hills', 'district_code' => 'SWKH'),
            array('state_id' => '23', 'name' => 'West Garo Hills', 'district_code' => 'WGH'),
            array('state_id' => '23', 'name' => 'West Jaintia Hills', 'district_code' => 'WJH'),
            array('state_id' => '23', 'name' => 'West Khasi Hills', 'district_code' => 'WKH'),

            array('state_id' => '33', 'name' => 'Dhalai', 'district_code' => 'DLA'),
            array('state_id' => '33', 'name' => 'Gomati', 'district_code' => 'GOM'),
            array('state_id' => '33', 'name' => 'Khowai', 'district_code' => 'KHO'),
            array('state_id' => '33', 'name' => 'North Tripura', 'district_code' => 'NTR'),
            array('state_id' => '33', 'name' => 'Sepahijala', 'district_code' => 'SPL'),
            array('state_id' => '33', 'name' => 'South Tripura', 'district_code' => 'STR'),
            array('state_id' => '33', 'name' => 'Unakoti', 'district_code' => 'UKT'),
            array('state_id' => '33', 'name' => 'West Tripura', 'district_code' => 'WTR'),

        ));
        

    }
}