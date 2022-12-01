<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Project::class;

    public function definition()
    {
        $start= rand(1672531200,1675036800);
        $end= rand(1675123200,1703894400);
        return [
            'name' => $this->faker->name,
            'manager' => rand(1,20),
            'client_id' => rand(1,20),
            'budget' => rand(10000000,100000000),
            'start_date' => date("Y-m-d H:i:s",$start),
            'end_date' => date("Y-m-d H:i:s",$end),
            'complexity_id' => rand(1,3),
            'priority_id' => rand(1,3),
            'status_id' => rand(1,5),
            'plan_hours' => rand(100,1000),
            'create_by' => 1,
        ];
    }
}