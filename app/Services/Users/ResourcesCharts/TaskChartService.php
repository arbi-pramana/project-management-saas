<?php
namespace App\Services\Users\ResourcesCharts;

use App\Models\Employee;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use stdClass;

class TaskChartService{
    
    public function chart()
    {
        $statuses = Status::get();
        foreach ($statuses as $i => $status) {
            $datasets[$status->name] = Task::where('status_id',$status->id)->get()
            ->groupBy('employee_id')
            ->map(function($q){
                $status = $q->count();
                return $status;
            });
        }

        $colors = [
            "Open" => "#3065D0",
            "In Progress" => "#ff9900",
            "Completed" => "#2BC155",
            "On Hold" => "#FF6D4D",
            "Cancelled" => "#FF4847",
        ];

        foreach ($datasets as $i => $data) {
            $dataset[] = [
                "label" => $i,
                "backgroundColor" => $colors[$i],
                "data" => array_values($data->toArray())
            ];
        }
        return $dataset;
    }

    public function label()
    {
        return Employee::where('create_by',Auth::guard('users')->id())->pluck('name');
    }
}