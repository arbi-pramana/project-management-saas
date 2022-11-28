<?php
namespace App\Services\Users\ExecutiveCharts;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class ResourceChartService{
    public function chart($request)
    {
        $employees = Employee::where('create_by',Auth::guard('users')->id())->get();
        $data['label'] = array_keys($employees->groupBy(function($q){
            return $q->name;
        })->toArray());

        if(!empty($request->year)){
            foreach ($employees as $i => $employee) {
                $data['value'][] = Task::where('create_by',Auth::guard('users')->id())
                    ->where('employee_id',$employee->id)
                    ->where
                    ('start_date','like','%'.$request->year.'%')->get()->count();
            }
        } else {
            foreach ($employees as $i => $employee) {
                $data['value'][] = Task::where('create_by',Auth::guard('users')->id())
                    ->where('employee_id',$employee->id)
                    ->get()
                    ->count();
            }
        }
        return $data;
    }
}