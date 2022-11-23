<?php
namespace App\Services\Users;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService{
    
    function store($request){
        $task = new Task();
        $task->wbs_code = $request->wbs_code;
        $task->milestone_id = $request->milestone_id;
        $task->employee_id = $request->employee_id;
        $task->name = $request->name;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->status_id = $request->status_id;
        $task->complexity_id = $request->complexity_id;
        $task->priority_id = $request->priority_id;
        $task->plan_hours = $request->plan_hours;
        $task->actual_hours = $request->actual_hours;
        $task->remarks = $request->remarks;
        $task->project_id = $request->project_id;
        $task->create_by = Auth::guard('users')->id();
        $task->save();
    }

    function update($request){
        $task = Task::find($request->id);
        $task->wbs_code = $request->wbs_code;
        $task->milestone_id = $request->milestone_id;
        $task->employee_id = $request->employee_id;
        $task->name = $request->name;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->status_id = $request->status_id;
        $task->complexity_id = $request->complexity_id;
        $task->priority_id = $request->priority_id;
        $task->plan_hours = $request->plan_hours;
        $task->actual_hours = $request->actual_hours;
        $task->remarks = $request->remarks;
        $task->project_id = $request->project_id;
        $task->create_by = Auth::guard('users')->id();
        $task->save();
    }
}