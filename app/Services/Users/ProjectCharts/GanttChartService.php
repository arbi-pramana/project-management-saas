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
                $data['progress'] = 100;
                return $data;
            });
        return $data;
    }
}