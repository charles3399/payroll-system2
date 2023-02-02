<?php

namespace App\Http\Services;

use App\Models\Employee;

class EmployeeServices {

    public function search_employee($data)
    {
        $employees = Employee::where('full_name', 'LIKE', '%'.$data.'%')
        ->orWhere('id', 'LIKE', '%'.$data.'%')
        ->with('position')
        ->paginate(10);

        return $employees;
    }
}