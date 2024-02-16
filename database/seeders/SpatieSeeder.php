<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            ['name' => 'add.house', 'group_name' => 'guest house'],
            ['name' => 'view.house', 'group_name' => 'guest house'],
            ['name' => 'edit.house', 'group_name' => 'guest house'],
            ['name' => 'delete.house', 'group_name' => 'guest house'],
            ['name' => 'add.category', 'group_name' => 'room category'],
            ['name' => 'view.category', 'group_name' => 'room category'],
            ['name' => 'edit.category', 'group_name' => 'room category'],
            ['name' => 'delete.category', 'group_name' => 'room category'],
            ['name' => 'add.room', 'group_name' => 'room'],
            ['name' => 'view.room', 'group_name' => 'room'],
            ['name' => 'edit.room', 'group_name' => 'room'],
            ['name' => 'delete.room', 'group_name' => 'room'],
            ['name' => 'add.settings', 'group_name' => 'settings'],
            ['name' => 'view.settings', 'group_name' => 'settings'],
            ['name' => 'edit.settings', 'group_name' => 'settings'],
            ['name' => 'delete.settings', 'group_name' => 'settings'],
            ['name' => 'add.reservation', 'group_name' => 'reservation'],
            ['name' => 'view.reservation', 'group_name' => 'reservation'],
            ['name' => 'edit.reservation', 'group_name' => 'reservation'],
            ['name' => 'delete.reservation', 'group_name' => 'reservation'],
            ['name' => 'add.subusers', 'group_name' => 'subusers'],
            ['name' => 'view.subusers', 'group_name' => 'subusers'],
            ['name' => 'edit.subusers', 'group_name' => 'subusers'],
            ['name' => 'delete.subusers', 'group_name' => 'subusers'],
            ['name' => 'view.logs', 'group_name' => 'logs'],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name'], 'group_name' => $permission['group_name'], 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->syncPermissions([
            'add.house',
            'view.house',
            'edit.house',
            'delete.house',
            'add.category',
            'view.category',
            'edit.category',
            'delete.category',
            'add.room',
            'view.room',
            'edit.room',
            'delete.room',
            'add.settings',
            'view.settings',
            'edit.settings',
            'delete.settings',
            'add.reservation',
            'view.reservation',
            'edit.reservation',
            'delete.reservation',
            'add.subusers',
            'view.subusers',
            'edit.subusers',
            'delete.subusers',
            'view.logs',
        ]);

        // Assign roles to users
        $adminUser = Admin::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $adminUser->assignRole($roleAdmin);

    }
}
