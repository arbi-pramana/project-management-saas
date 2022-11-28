<?php
namespace App\Services\Users\ResourcesCharts;

use App\Models\Employee;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskChartService{
    
    public function chart()
    {
        $datasets = Task::where('create_by',Auth::guard('users')->id())
            ->get()
            ->map(function($q){
                $q['emp_name'] = $q->employee->name;
                return $q;
            })
            ->groupBy('emp_name');
        
        foreach ($datasets as $i => $data) {
            $dataset[] = $data->count();
        }
        return $dataset ?? [];
    }

    public function label()
    {
        return Employee::where('create_by',Auth::guard('users')->id())->pluck('name');
    }

    public function task_assigned($request)
    {
        if($request->employee_id == null){
            return Task::where('create_by',Auth::guard('users')->id())
                ->get()
                ->count();
        } else {
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('employee_id',$request->employee_id)
                ->get()
                ->count();
        }
    }

    public function due_this_month($request)
    {
        if($request->employee_id == null){
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id',"!=",3)
                ->whereMonth('start_date',date("m"))
                ->get()
                ->count();
        } else {
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id',"!=",3)
                ->whereMonth('start_date',date("m"))
                ->where('employee_id',$request->employee_id)
                ->get()
                ->count();
        }
    }

    public function due_next_month($request)
    {
        if($request->employee_id == null){
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id',"!=",3)
                ->whereMonth('start_date',date("m"."+1 month"))
                ->get()
                ->count();
        } else {
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id',"!=",3)
                ->whereMonth('start_date',date("m"."+1 month"))
                ->where('employee_id',$request->employee_id)
                ->get()
                ->count();
        }
    }

    public function due_this_year($request)
    {
        if($request->employee_id == null){
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id','!=',3)
                ->whereYear('start_date',date("Y"))
                ->get()
                ->count();
        } else {
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id','!=',3)
                ->whereYear('start_date',date("Y"))
                ->where('employee_id',$request->employee_id)
                ->get()
                ->count();
        }
    }

    public function due_next_year($request)
    {
        if($request->employee_id == null){
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id','!=',3)
                ->whereYear('start_date',now()->addYear())
                ->get()
                ->count();
        } else {
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id','!=',3)
                ->whereYear('start_date',now()->addYear())
                ->where('employee_id',$request->employee_id)
                ->get()
                ->count();
        }
    }

    public function task_completed($request)
    {
        if($request->employee_id == null){
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id',3)
                ->get()
                ->count();
        } else {
            return Task::where('create_by',Auth::guard('users')->id())
                ->where('status_id',3)
                ->where('employee_id',$request->employee_id)
                ->get()
                ->count();
        }
    }

    public function task_progress($request)
    {
        if($request->employee_id == null){
            $data['label'] = array_keys(Status::get()->groupBy(function($q){
                return $q->name;
            })->toArray());
            $data['value'] = [
                Task::where('status_id',1)->get()->count(),
                Task::where('status_id',2)->get()->count(),
                Task::where('status_id',3)->get()->count(),
                Task::where('status_id',4)->get()->count(),
                Task::where('status_id',5)->get()->count(),
            ];
            return $data;
        } else {
            $data['label'] = array_keys(Status::get()->groupBy(function($q){
                return $q->name;
            })->toArray());
            $data['value'] = [
                Task::where('employee_id',$request->employee_id)->where('status_id',1)->get()->count(),
                Task::where('employee_id',$request->employee_id)->where('status_id',2)->get()->count(),
                Task::where('employee_id',$request->employee_id)->where('status_id',3)->get()->count(),
                Task::where('employee_id',$request->employee_id)->where('status_id',4)->get()->count(),
                Task::where('employee_id',$request->employee_id)->where('status_id',5)->get()->count(),
            ];
            return $data;
        }
    }

    public function priority($id)
    {
        $data['label'] = array_keys(Priority::get()->groupBy(function($q){
            return $q->name;
        })->toArray());
        $data['value'] = [
            Task::where('create_by',Auth::guard('users')->id())->where('priority_id',1)->get()->count(),
            Task::where('create_by',Auth::guard('users')->id())->where('priority_id',2)->get()->count(),
            Task::where('create_by',Auth::guard('users')->id())->where('priority_id',3)->get()->count(),
        ];
        return $data;
    }
}