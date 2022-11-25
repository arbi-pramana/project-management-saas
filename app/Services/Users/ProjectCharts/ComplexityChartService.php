<?php

namespace App\Services\Users\ProjectCharts;

use App\Models\Complexity;
use App\Models\Task;

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
}