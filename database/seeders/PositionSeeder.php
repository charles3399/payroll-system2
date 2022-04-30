<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::insert([
            'position_name' => 'Junior Web Developer',
            'basic_pay' => 121
        ]);

        Position::insert([
            'position_name' => 'Senior Web Developer',
            'basic_pay' => 400
        ]);

        Position::insert([
            'position_name' => 'Quality Assurance Analyst',
            'basic_pay' => 250
        ]);

        Position::insert([
            'position_name' => 'Project Manager',
            'basic_pay' => 500
        ]);

        Position::insert([
            'position_name' => 'Human Resource Staff',
            'basic_pay' => 300
        ]);
    }
}
