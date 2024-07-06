<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_agreen_number' => Str::random(20),
            'employeeName' => fake()->unique()->name(),
            'role' => fake()->jobTitle(),
            'startDate' => fake()->date(),
            'endDate' => fake()->date(),
            'salary' => fake()->randomFloat(2, 1000, 1000000), // Adjust range to fit within column limits
            'terms' => fake()->text(),
        ];
    }
}
