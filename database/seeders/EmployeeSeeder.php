<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
Use App\Models\Position;
use Faker\Generator as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 100; $i++) {
            Employee::insert([
                'full_name' => $faker->name(),
                'email' => $faker->email(),
                'address' => $faker->address(),
                'gender' => rand(0, 1) ? 'Male' : 'Female',
                'position_id' => rand(1, count(Position::all())),
                'created_at' => now(),
                'updated_at' => now(),
                'passers_id' => 0,
            ]);
        }
    }
}
