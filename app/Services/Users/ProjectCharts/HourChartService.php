<?php

namespace App\Services\Users\ProjectCharts;

use App\Models\Task;
use Carbon\Carbon;

class HourChartService{
    
    public function chart($id)
    {
        $tasks = Task::where('project_id',$id)->get()
            ->groupBy(function($q){
                return Carbon::parse($q->start_date)->format('M Y');
            });

        foreach ($tasks as $i => $task) {
            $label[] = $i;
            $plan_hours[] = $task->sum('plan_hours');
            $actual_hours[] = $task->sum('actual_hours');
        }
        
        //label
        $data['label'] = $label ?? null;
        $data['plan_hours'] = $plan_hours ?? null;
        $data['actual_hours'] = $actual_hours ?? null;
        return $data;
    }
}