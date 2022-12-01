<?php
namespace App\Services\Users\ExecutiveCharts;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class BudgetChartService{
    public function budget($request)
    {
        if(!empty($request->year)){
            $projects = Project::where('create_by',Auth::guard('users')->id())
                ->where('start_date','like','%'.$request->year.'%')
                ->get();
        } else {
            $projects = Project::where('create_by',Auth::guard('users')->id())->get();
        }
        $label = $projects->pluck('name');
        $data['label'] = $label->toArray();

        foreach($projects as $project){
            $data['budget'][] = $project->budget;
            $data['income'][] = $project->incomes->sum('paid');
            $data['budget_remaining'][] = $project->budget-$project->incomes->sum('paid');
        }
        return $data;
    }

    public function expense($request)
    {
        if(!empty($request->year)){
            $projects = Project::where('create_by',Auth::guard('users')->id())
                ->where('start_date','like','%'.$request->year.'%')
                ->get();
        } else {
            $projects = Project::where('create_by',Auth::guard('users')->id())->get();
        }
        $label = $projects->pluck('name');
        $data['label'] = $label->toArray();

        foreach($projects as $project){
            $data['expense'][] = $project->expenses->sum('amount');
        }
        return $data;
    }
}