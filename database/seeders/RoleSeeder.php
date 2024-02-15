<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert(array(
            array('name' => 'super admin', 'guard_name' => 'web', 'role_group' => 'super admin'),

            array('name' => 'admin', 'guard_name' => 'web', 'role_group' => 'guest house admin'),
            array('name' => 'accountant', 'guard_name' => 'web', 'role_group' => 'guest house admin'),
            array('name' => 'approver', 'guard_name' => 'web', 'role_group' => 'guest house admin'),
            array('name' => 'receptionist', 'guard_name' => 'web', 'role_group' => 'guest house admin'),

            array('name' => 'government', 'guard_name' => 'web', 'role_group' => 'guest'),
            array('name' => 'general', 'guard_name' => 'web', 'role_group' => 'guest'),
        ));
    }
}
