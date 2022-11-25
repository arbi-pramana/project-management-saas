<?php

namespace App\Services\Users\ProjectCharts;

use App\Models\Priority;
use App\Models\Task;

class PriorityChartService{

    public function chart($id)
    {
        $data['label'] = array_keys(Priority::get()->groupBy(function($q){
            return $q->name;
        })->toArray());
        $data['value'] = [
            Task::where('project_id',$id)->where('priority_id',1)->get()->count(),
            Task::where('project_id',$id)->where('priority_id',2)->get()->count(),
            Task::where('project_id',$id)->where('priority_id',3)->get()->count(),
        ];
        return $data;
    }
}