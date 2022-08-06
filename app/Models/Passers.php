<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Passers extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'employee_id',
        'reason',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
