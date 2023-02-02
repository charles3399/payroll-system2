<?php

namespace App\Http\Services;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\PayrollRequest;
use App\Http\Resources\PayrollResource;

class PayrollServices {

    public function search_payroll($toSearch)
    {
        $item = Payroll::whereHas('employee', function($query) use($toSearch) {
            $query->where('full_name', 'LIKE', '%'.$toSearch.'%');
        })
        ->orWhereHas('employee.position', function($query) use($toSearch) {
            $query->where('position_name', 'LIKE', '%'.$toSearch.'%');
        })
        ->with(['employee', 'employee.position'])
        ->paginate(10);

        return $item;
    }
}