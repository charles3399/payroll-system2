<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\PayrollRequest;
use App\Http\Resources\PayrollResource;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payrolls = Payroll::with(['employee', 'employee.position'])->paginate(10);

        return PayrollResource::collection($payrolls);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayrollRequest $request)
    {
        $payroll = Payroll::create($request->validated());
        $payroll->employee()->attach($request->input('employee_id'));

        return new PayrollResource($payroll);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        $payroll->load(['employee','employee.position']);

        return new PayrollResource($payroll);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(PayrollRequest $request, Payroll $payroll)
    {
        $payroll->update($request->validated());
        $payroll->employee()->sync($request->input('employee_id'));
        
        return new PayrollResource($payroll);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return response()->noContent();
    }

    public function showPayrolls() {
        $payrolls = Payroll::all();

        return PayrollResource::collection($payrolls);
    }
}
