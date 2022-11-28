<?php
namespace App\Services\Users\ResourcesCharts;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class HoursChartService{
    
    public function chart()
    {
        $hours = Task::where('create_by',Auth::guard('users')->id())
            ->get()
            ->map(function($q){
                $q['emp_name'] = $q->employee->name;
                return $q;
            })
            ->groupBy('emp_name');

        $data['label'] = array_keys($hours->toArray());
        foreach ($hours as $i => $hour) {
            $plan_hours[] = $hour->sum('plan_hours');
        }
        $data['plan_hours'] = $plan_hours ?? [];

        foreach ($hours as $i => $hour) {
            $actual_hours[] = $hour->sum('actual_hours');
        }
        $data['actual_hours'] = $actual_hours ?? [];

        return $data;
    }
}