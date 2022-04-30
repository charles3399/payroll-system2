<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Position extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'position_name',
        'basic_pay'
    ];

    public function employee() {
        return $this->hasMany(Employee::class);
    }
}
