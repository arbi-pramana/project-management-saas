<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Task::class;

    public function definition()
    {
        $start= rand(1669852800,1701388800);
        $end= rand(1685577600,1701388800);
        return [
            'project_id'=>rand(1,20),
            'milestone_id'=>rand(1,3),
            'employee_id'=>rand(1,20),
            'wbs_code' => $this->faker->ean8,
            'name' => "Task ".$this->faker->ean8,
            'start_date' => date("Y-m-d H:i:s",$start),
            'end_date' => date("Y-m-d H:i:s",$end),
            'complexity_id' => rand(1,3),
            'priority_id' => rand(1,3),
            'status_id' => rand(1,3),
            'plan_hours'=> rand(10,100),
            'actual_hours'=>rand(10,100),
            'remarks'=>"AP",
            'create_by' => 1,
        ];
    }
}
