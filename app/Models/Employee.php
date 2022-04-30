<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'full_name',
        'email',
        'address',
        'gender',
        'position_id'
    ];

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function payroll() {
        return $this->belongsToMany(Payroll::class);
    }
}
