<?php
namespace App\Services\Users\ProjectCharts;

use App\Models\Task;

class GanttChartService{
    public function chart($id)
    {
        $data['tasks'] = Task::where('project_id',$id)->get()
            ->map(function($q) {
                $data['id'] = $q->wbs_code;
                $data['name'] = $q->name;
                $data['start'] = $q->start_date;
                $data['end'] = $q->end_date;
                $data['format_start'] = date("d M Y",strtotime($q->start_date));
                $data['format_end'] = date("d M Y",strtotime($q->end_date));
                $data['status'] = $q->status->name;
                $data['complexity'] = $q->complexity->name;
                $data['priority'] = $q->priority->name;
                if($q->status_id == 1){
                    $data['progress'] = 0;
                } else if($q->status_id == 2){
                    $data['progress'] = 50;
                } else if($q->status_id == 3){
                    $data['progress'] = 100;
                } else {
                    $data['progress'] = 0;
                }
                return $data;
            });
        return $data;
    }
}