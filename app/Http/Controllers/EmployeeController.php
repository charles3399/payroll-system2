<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Passers;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\PassersRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\PassersResource;
use DB;

use App\Http\Services\EmployeeServices;

class EmployeeController extends Controller
{
    protected $employeeServices;

    public function __construct(EmployeeServices $employeeServices)
    {
        $this->employeeServices = $employeeServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->searchEmployee;

        $employees = $this->employeeServices->search_employee($search);

        return EmployeeResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());

        return new EmployeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {   
        $employee->load('position');
        
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->noContent();
    }

    public function showEmployees()
    {
        $employees = Employee::all();

        return EmployeeResource::collection($employees);
    }

    public function setPasser(PassersRequest $request)
    {
        $passer = Passers::create($request->validated());

        Employee::where('id', $passer->employee_id)->update(['passers_id' => $passer->id]);

        return new PassersResource($passer);
    }
}
