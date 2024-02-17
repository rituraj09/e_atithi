<?php

namespace Database\Seeders;

use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // default super admin
        $adminUser = new Admin;
        $adminUser->admin_name = 'Super User';
        $adminUser->email = 'admin@admin.com';
        $adminUser->phone = '7002274743';
        $adminUser->password = bcrypt('admin123');
        $adminUser->role = 1;
        $adminUser->created_at = '2024-02-15';
        $adminUser->save();

        $role = Role::findById($adminUser->role, 'web');  // Assuming 'web' is the intended guard
        $adminUser->assignRole($role);
        $permissions = $role->permissions;
        // $permissions = DB::select('select * from role_has_permissions where role_id = ?', [1]);
        $adminUser->givePermissionTo($permissions);


        // default admin
        $adminUser2 = new Admin;
        $adminUser2->admin_name = 'Admin User';
        $adminUser2->email = 'new@admin';
        $adminUser2->phone = '7002274943';
        $adminUser2->password = bcrypt('admin123');
        $adminUser2->role = 2;
        $adminUser2->created_at = '2024-02-15';
        $adminUser2->save();

        // $roleAdmin2 = Role::where('name', 'admin')->first();
        $adminUser2->assignRole(2);
        $permissions = $role->permissions;
        // $permissions = DB::select('select * from role_has_permissions where role_id = ?', [1]);
        $adminUser2->givePermissionTo($permissions);
    }
}
