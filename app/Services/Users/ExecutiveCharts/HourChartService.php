<?php

namespace App\Services\Users\ExecutiveCharts;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HourChartService{
    
    public function chart($request)
    {
        if(!empty($request->year)){
            $tasks = Task::where('create_by',Auth::guard('users')->id())
                ->where('start_date','like','%'.$request->year.'%')
                ->get()
                ->groupBy(function($q){
                    return Carbon::parse($q->start_date)->format('M Y');
                });
        } else {
            $tasks = Task::where('create_by',Auth::guard('users')->id())
                ->get()
                ->groupBy(function($q){
                    return Carbon::parse($q->start_date)->format('M Y');
                });
        }

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