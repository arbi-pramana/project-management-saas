<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'code' => $this->faker->ean8,
            'name' => $this->faker->name,
            'employee_type_id' => rand(1,4),
            'department_id' => rand(1,4),
            'create_by' => 1,
        ];
    }
}

// To running
// \App\Models\Employee::factory(10)->create()