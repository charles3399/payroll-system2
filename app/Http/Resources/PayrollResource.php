<?php

namespace App\Http\Resources;

use DB;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Payroll;
use Illuminate\Http\Resources\Json\JsonResource;

class PayrollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'employee_id' => EmployeeResource::collection($this->whenLoaded('employee')->load('position')),
            'days_worked' => $this->days_worked,
            'overtime' => $this->overtime,
            'late' => $this->late,
            'absences' => $this->absences,
            'bonuses' => $this->bonuses,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
