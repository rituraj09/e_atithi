<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('permissions')->insert(array(

            // guest house
            array('id' => '1' ,'name' => 'add.house', 'guard_name' => 'web', 'group_name' => 'guest house'),
            array('id' => '2' ,'name' => 'view.house', 'guard_name' => 'web', 'group_name' => 'guest house'),
            array('id' => '3' ,'name' => 'edit.house', 'guard_name' => 'web', 'group_name' => 'guest house'),
            array('id' => '4' ,'name' => 'delete.house', 'guard_name' => 'web', 'group_name' => 'guest house'),

            // room category
            array('id' => '5' ,'name' => 'add.category', 'guard_name' => 'web', 'group_name' => 'room category'),
            array('id' => '6' ,'name' => 'view.category', 'guard_name' => 'web', 'group_name' => 'room category'),
            array('id' => '7' ,'name' => 'edit.category', 'guard_name' => 'web', 'group_name' => 'room category'),
            array('id' => '8' ,'name' => 'delete.category', 'guard_name' => 'web', 'group_name' => 'room category'),

            // room
            array('id' => '9' ,'name' => 'add.room', 'guard_name' => 'web', 'group_name' => 'room'),
            array('id' => '10' ,'name' => 'view.room', 'guard_name' => 'web', 'group_name' => 'room'),
            array('id' => '11' ,'name' => 'edit.room', 'guard_name' => 'web', 'group_name' => 'room'),
            array('id' => '12' ,'name' => 'delete.room', 'guard_name' => 'web', 'group_name' => 'room'),

            // settings
            array('id' => '13' ,'name' => 'add.settings', 'guard_name' => 'web', 'group_name' => 'settings'),
            array('id' => '14' ,'name' => 'view.settings', 'guard_name' => 'web', 'group_name' => 'settings'),
            array('id' => '15' ,'name' => 'edit.settings', 'guard_name' => 'web', 'group_name' => 'settings'),
            array('id' => '16' ,'name' => 'delete.settings', 'guard_name' => 'web', 'group_name' => 'settings'),

            // reservations
            array('id' => '17' ,'name' => 'add.reservation', 'guard_name' => 'web', 'group_name' => 'reservation'),
            array('id' => '18' ,'name' => 'view.reservation', 'guard_name' => 'web', 'group_name' => 'reservation'),
            array('id' => '19' ,'name' => 'edit.reservation', 'guard_name' => 'web', 'group_name' => 'reservation'),
            array('id' => '20' ,'name' => 'delete.reservation', 'guard_name' => 'web', 'group_name' => 'reservation'),

            // subusers
            array('id' => '21' ,'name' => 'add.subusers', 'guard_name' => 'web', 'group_name' => 'subusers'),
            array('id' => '22' ,'name' => 'view.subusers', 'guard_name' => 'web', 'group_name' => 'subusers'),
            array('id' => '23' ,'name' => 'edit.subusers', 'guard_name' => 'web', 'group_name' => 'subusers'),
            array('id' => '24' ,'name' => 'delete.subusers', 'guard_name' => 'web', 'group_name' => 'subusers'),

            // logs
            array('id' => '25' ,'name' => 'view.logs', 'guard_name' => 'web', 'group_name' => 'logs'),

        ));
    }
}
