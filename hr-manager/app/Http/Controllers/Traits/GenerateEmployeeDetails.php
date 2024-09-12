<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;

trait GenerateEmployeeDetails
{
    /**
     * Generate an employee ID based on department name, current month/year, and employee count.
     *
     * @param string $department
     * @param int $numEmployees
     * @return string
     */
    public function generateEmployeeID($department, $numEmployees)
    {
        // Get the first 3 letters of the department name
        $deptCode = strtoupper(substr($department, 0, 3));

        // Get the current month and year using Carbon
        $currentDate = Carbon::now()->format('my'); // 'my' gives the format MMYY

        // Increment the number of employees by 1
        $employeeNumber = $numEmployees + 1;

        // Combine them to form the employee ID
        $employeeID = $deptCode . $currentDate . str_pad($employeeNumber, 3, '0', STR_PAD_LEFT);

        return $employeeID;
    }


}
