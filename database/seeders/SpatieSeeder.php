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
            ['id' => '1', 'name' => 'add.house', 'group_name' => 'guest house'],
            ['id' => '2', 'name' => 'view.house', 'group_name' => 'guest house'],
            ['id' => '3', 'name' => 'edit.house', 'group_name' => 'guest house'],
            ['id' => '4', 'name' => 'delete.house', 'group_name' => 'guest house'],
            ['id' => '5', 'name' => 'add.category', 'group_name' => 'room category'],
            ['id' => '6', 'name' => 'view.category', 'group_name' => 'room category'],
            ['id' => '7', 'name' => 'edit.category', 'group_name' => 'room category'],
            ['id' => '8', 'name' => 'delete.category', 'group_name' => 'room category'],
            ['id' => '9', 'name' => 'add.room', 'group_name' => 'room'],
            ['id' => '10', 'name' => 'view.room', 'group_name' => 'room'],
            ['id' => '11', 'name' => 'edit.room', 'group_name' => 'room'],
            ['id' => '12', 'name' => 'delete.room', 'group_name' => 'room'],
            ['id' => '13', 'name' => 'add.settings', 'group_name' => 'settings'],
            ['id' => '14', 'name' => 'view.settings', 'group_name' => 'settings'],
            ['id' => '15', 'name' => 'edit.settings', 'group_name' => 'settings'],
            ['id' => '16', 'name' => 'delete.settings', 'group_name' => 'settings'],
            ['id' => '17', 'name' => 'add.reservation', 'group_name' => 'reservation'],
            ['id' => '18', 'name' => 'view.reservation', 'group_name' => 'reservation'],
            ['id' => '19', 'name' => 'edit.reservation', 'group_name' => 'reservation'],
            ['id' => '20', 'name' => 'delete.reservation', 'group_name' => 'reservation'],
            ['id' => '21', 'name' => 'add.subusers', 'group_name' => 'subusers'],
            ['id' => '22', 'name' => 'view.subusers', 'group_name' => 'subusers'],
            ['id' => '23', 'name' => 'edit.subusers', 'group_name' => 'subusers'],
            ['id' => '24', 'name' => 'delete.subusers', 'group_name' => 'subusers'],
            ['id' => '25', 'name' => 'view.logs', 'group_name' => 'logs'],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name'], 'group_name' => $permission['group_name'], 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $roleSuperAdmin = Role::create(['name' => 'super admin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleApprover = Role::create(['name' => 'approver']);
        $roleAccountant = Role::create(['name' => 'accountant']);
        $roleReceptionist = Role::create(['name' => 'receptionist']);
        $roleSuperAdmin->syncPermissions([
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
        $roleAdmin->syncPermissions([
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
        ]);
        $roleApprover->syncPermissions([
            'add.reservation',
            'view.reservation',
            'edit.reservation',
            'delete.reservation',
        ]);

        // Assign roles to users
        // $adminUser = Admin::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        // ]);
        // $adminUser->assignRole($roleAdmin);

    }
}
