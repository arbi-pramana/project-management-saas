<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\Users\ProjectCharts\ComplexityChartService;
use App\Services\Users\ProjectCharts\HourChartService;
use App\Services\Users\ProjectCharts\IncomeExpenseChartService;
use App\Services\Users\ProjectCharts\PriorityChartService;
use App\Services\Users\ProjectCharts\ResponsibleChartService;
use App\Services\Users\ProjectCharts\StatusChartService;
use App\Services\Users\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $project;
    protected $income_expense_chart;
    protected $hours_chart;
    protected $responsible_chart;
    protected $status_chart;
    protected $priority_chart;
    protected $complexity_chart;
    public function __construct(
        ProjectService $project, 
        IncomeExpenseChartService $income_expense_chart,
        HourChartService $hours_chart,
        ResponsibleChartService $responsible_chart,
        StatusChartService $status_chart,
        PriorityChartService $priority_chart,
        ComplexityChartService $complexity_chart,
    ){
        $this->project = $project;
        $this->income_expense_chart = $income_expense_chart;
        $this->hours_chart = $hours_chart;
        $this->responsible_chart = $responsible_chart;
        $this->status_chart = $status_chart;
        $this->priority_chart = $priority_chart;
        $this->complexity_chart = $complexity_chart;
    }

    public function index()
    {
        $data = $this->project->index();
        return view('users.project.index',$data);
    }

    public function detail($id)
    {
        $data = $this->project->detail($id);
        $data['income_expense_chart'] = $this->income_expense_chart->chart($id); 
        $data['hours_chart'] = $this->hours_chart->chart($id); 
        $data['responsible_chart'] = $this->responsible_chart->chart($id); 
        $data['status_chart'] = $this->status_chart->chart($id);
        $data['priority_chart'] = $this->priority_chart->chart($id);
        $data['complexity_chart'] = $this->complexity_chart->chart($id);
        return view('users.project.detail',$data);
    }

    public function store(Request $request)
    {
        $this->project->store($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function update(Request $request)
    {
        $this->project->update($request);
        return redirect()->back()->with('success','Data has been Updated');
    }

    public function destroy(Request $request)
    {
        Project::find($request->id)->delete();
        return redirect('users/project')->with('danger','Data has been Deleted');
    }
}
