<?php

namespace Database\Seeders;

use App\Models\Access;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employees;
use App\Models\Users;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role as ModelsRole;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create Employee
       $employee = Employees::create([
        'first_name' => 'Admin',
        'last_name' => 'Admin',
        'email' => 'admin@example.com',
    ]);

    // Create User
    $user = Users::create([
        'user_id' => $employee->user_id,
        'email' => $employee->email,
        'password' => Hash::make('adminpassword123'),
    ]);

    // // Assign Admin Role
    // $adminRole = Access::where('access_level', 'admin')->first();
    // $user->roles()->attach($adminRole);
    $adminRole = ModelsRole::firstOrCreate(['name' => 'super admin']); // Ensures the 'admin' role exists
        $employee->assignRole($adminRole); // Assigns the 'admin' role to the user
     }
}
