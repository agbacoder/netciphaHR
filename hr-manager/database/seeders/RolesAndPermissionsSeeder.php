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
         // Create permissions for each module
         $modules = ['employees', 'leaves', 'projects', 'auth', 'files', 'documents', 'folders'];

         // Loop through each module to create common permissions (CRUD operations)
         foreach ($modules as $module) {
             Permission::create(['name' => 'view ' . $module]);
             Permission::create(['name' => 'create ' . $module]);
             Permission::create(['name' => 'edit ' . $module]);
             Permission::create(['name' => 'delete ' . $module]);
         }

         // Create roles and assign permissions
         $superAdmin = Role::create(['name' => 'super admin']);
         $manager = Role::create(['name' => 'manager']);
         $hr = Role::create(['name' => 'hr']);
         $user = Role::create(['name' => 'user']);

         // Assign all permissions to Super Admin
         $superAdmin->givePermissionTo(Permission::all());

         // Assign module-specific permissions to Manager
         $manager->givePermissionTo([
             'view employees', 'create employees', 'edit employees', 'delete employees',
             'view projects', 'create projects', 'edit projects', 'delete projects',
             'view leaves', 'view files'
         ]);

         // Assign HR-specific permissions
         $hr->givePermissionTo([
             'view employees', 'create employees', 'edit employees', 'delete employees',
             'view leaves',
         ]);

         // Assign basic permissions to User
         $user->givePermissionTo([
             'view documents', 'view files', 'view leaves', 'view projects'
         ]);
    }
}
