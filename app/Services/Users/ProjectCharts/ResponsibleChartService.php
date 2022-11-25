<?php
namespace App\Services\Users\ProjectCharts;

use App\Models\Employee;
use App\Models\Task;

class ResponsibleChartService{
    
    public function chart($id)
    {
        $tasks = Task::with('employee')->where('project_id',$id)->get()
            ->groupBy("employee_id");

        foreach ($tasks as $i => $task) {
            $label[] = Employee::find($i)->name;
            $plan_task[] = $task->count();
            $completed_task[] = $task->where('status_id',3)->count();
        }
        
        //label
        $data['label'] = $label ?? null;
        $data['plan_task'] = $plan_task ?? null;
        $data['completed_task'] = $completed_task ?? null;
        return $data;
    }
}