<?php
namespace App\Services\Users\ExecutiveCharts;

use App\Models\Status;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskChartService{
    public function tasks($request)
    {
        if($request->year == null){
            $data['label'] = array_keys(Status::get()->groupBy(function($q){
                return $q->name;
            })->toArray());
            $data['value'] = [
                Task::where('create_by',Auth::guard('users')->id())->where('status_id',1)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('status_id',2)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('status_id',3)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('status_id',4)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('status_id',5)->get()->count(),
            ];
            return $data;
        } else {
            $data['label'] = array_keys(Status::get()->groupBy(function($q){
                return $q->name;
            })->toArray());
            $data['value'] = [
                Task::where('create_by',Auth::guard('users')->id())->where('start_date','like','%'.$request->year.'%')->where('status_id',1)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('start_date','like','%'.$request->year.'%')->where('status_id',2)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('start_date','like','%'.$request->year.'%')->where('status_id',3)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('start_date','like','%'.$request->year.'%')->where('status_id',4)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('start_date','like','%'.$request->year.'%')->where('status_id',5)->get()->count(),
            ];
            return $data;
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
}