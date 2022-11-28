<?php

namespace App\Services\Users\ProjectCharts;

use App\Models\Complexity;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class ComplexityChartService{

    public function chart($id)
    {
        $data['label'] = array_keys(Complexity::get()->groupBy(function($q){
            return $q->name;
        })->toArray());
        $data['value'] = [
            Task::where('project_id',$id)->where('complexity_id',1)->get()->count(),
            Task::where('project_id',$id)->where('complexity_id',2)->get()->count(),
            Task::where('project_id',$id)->where('complexity_id',3)->get()->count(),
        ];
        return $data;
    }

    public function executive_chart($request)
    {
        $data['label'] = array_keys(Complexity::get()->groupBy(function($q){
            return $q->name;
        })->toArray());
        if(!empty($request->year)){
            $data['value'] = [
                Task::where('create_by',Auth::guard('users')->id())->where('start_date','like','%'.$request->year.'%')->where('complexity_id',1)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('start_date','like','%'.$request->year.'%')->where('complexity_id',2)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('start_date','like','%'.$request->year.'%')->where('complexity_id',3)->get()->count(),
            ];
        } else {
            $data['value'] = [
                Task::where('create_by',Auth::guard('users')->id())->where('complexity_id',1)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('complexity_id',2)->get()->count(),
                Task::where('create_by',Auth::guard('users')->id())->where('complexity_id',3)->get()->count(),
            ];
        }
        return $data;
    }
}