<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Payroll extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'employee_id',
        'days_worked',
        'overtime',
        'late',
        'absences',
        'bonuses'
    ];

    public function employee() {
        return $this->belongsToMany(Employee::class)->withTimestamps();
    }
}
