<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'days_worked',
        'overtime',
        'late',
        'absences',
        'bonuses'
    ];

    public function employee() {
        return $this->belongsToMany(Employee::class);
    }
}
