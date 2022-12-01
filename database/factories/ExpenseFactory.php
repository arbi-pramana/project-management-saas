<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Lorem;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Expense::class;

    public function definition()
    {
        $date= rand(1672531200,1703894400);

        return [
            'project_id' => rand(1,20),
            'date' => date("Y-m-d H:i:s",$date),
            'description' => Lorem::sentence(6,true),
            'reference_number'=>$this->faker->ean8,
            'amount' => rand(1000000,10000000),
            'remarks' => "AP",
            'create_by' => 1,
        ];
    }
}
