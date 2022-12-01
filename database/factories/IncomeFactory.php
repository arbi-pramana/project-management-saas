<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Income::class;

    public function definition()
    {
        $date= rand(1672531200,1703894400);

        return [
            'project_id' => rand(1,20),
            'invoice_number' => "INV-".$this->faker->ean8,
            'date' => date("Y-m-d H:i:s",$date),
            'amount' => rand(1000000,10000000),
            'paid' => rand(1000000,10000000),
            'remarks' => "AP",
            'create_by' => 1,
        ];
    }
}
