<?php

namespace Database\Seeders;

use Database\Factories\EmployeesFactory;
use Database\Seeders\Traits\ForeignKeyCheck;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    use TruncateTable, ForeignKeyCheck;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();
        $this->truncate('employees');
        $employees = \App\Models\Employees::factory(10)->create();
        $this->enableForeignKeys();

    }
}
