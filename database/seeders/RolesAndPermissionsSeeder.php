<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Roles
        // Role::create(['name' => 'Admin']);
        // Role::create(['name' => 'super admin']);
        // Role::create(['name' => 'Student']);

        // Create Permissions
        // Permission::create(['name' => 'edit courses']);
        // Permission::create(['name' => 'view profile']);
        // Permission::create(['name' => 'edit profile']);
        // Permission::create(['name' => 'add courses']);
        // Permission::create(['name' => 'register courses']);
        // Permission::create(['name' => 'review permissions']);
        // Permission::create(['name' => 'view result']);

        // Assign Permission/s to role
        // $adminRole = Role::findByName('Admin');
        // $adminRole->givePermissionTo('edit courses', 'view profile', 'edit profile', 'view result');
        // $adminRole->givePermissionTo('view result');

        // $superAdminRole = Role::findByName('super admin');
        // $superAdminRole->givePermissionTo('edit courses', 'view profile', 'edit profile', 'add courses', 'review permissions', 'view result');
        // $superAdminRole->givePermissionTo('view result');

        // $studentRole = Role::findByName('Student');
        // $studentRole->givePermissionTo('view profile', 'edit profile', 'register courses', 'view result');
        // $studentRole->givePermissionTo('view result');
    }
}
