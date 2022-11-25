<?php

namespace App\Services\Users\ProjectCharts;

use App\Models\Status;
use App\Models\Task;

class StatusChartService{

    public function chart($id)
    {
        $data['label'] = array_keys(Status::get()->groupBy(function($q){
            return $q->name;
        })->toArray());
        $data['value'] = [
            Task::where('project_id',$id)->where('status_id',1)->get()->count(),
            Task::where('project_id',$id)->where('status_id',2)->get()->count(),
            Task::where('project_id',$id)->where('status_id',3)->get()->count(),
            Task::where('project_id',$id)->where('status_id',4)->get()->count(),
            Task::where('project_id',$id)->where('status_id',5)->get()->count(),
        ];
        return $data;
    }
}