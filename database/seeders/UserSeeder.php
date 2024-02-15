<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert(array(
            array('admin_name'=>'Super User', 'email' => 'admin@admin.com', 'phone'=> '7002274743', 'password' => bcrypt('admin123'), 'role' => 1,'created_at'=>'2024-02-15' )
        ));
    }
}
