<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Task;
use App\Services\Users\ProjectCharts\ComplexityChartService;
use App\Services\Users\ProjectCharts\PriorityChartService;
use App\Services\Users\ResourcesCharts\HoursChartService;
use App\Services\Users\ResourcesCharts\TaskChartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $hours;
    protected $tasks;
    public function __construct(
        HoursChartService $hours,
        TaskChartService $tasks,
        PriorityChartService $priority_chart,
        ComplexityChartService $complexity_chart,
    ){
        $this->hours = $hours;
        $this->tasks = $tasks;
        $this->priority_chart = $priority_chart;
        $this->complexity_chart = $complexity_chart;
    }

    public function index()
    {
        return view('users.dashboard.index');
    }

    public function resources(Request $request)
    {
        $data['hours'] = $this->hours->chart();
        $data['tasks_label'] = $this->tasks->label();
        $data['tasks'] = $this->tasks->chart();
        $data['employees'] = Employee::where('create_by',Auth::guard('users')->id())->get();
        $data['task_assigned'] = $this->tasks->task_assigned($request);
        $data['task_completed'] = $this->tasks->task_completed($request);
        $data['due_this_month'] = $this->tasks->due_this_month($request);
        $data['due_next_month'] = $this->tasks->due_next_month($request);
        $data['due_this_year'] = $this->tasks->due_this_year($request);
        $data['due_next_year'] = $this->tasks->due_next_year($request);
        $data['task_progress'] = $this->tasks->task_progress($request);
        return view('users.dashboard.resources',$data);
    }

    public function executive(Request $request)
    {
        $data['years'] = Project::where('create_by',Auth::guard('users')->id())
            ->get()
            ->pluck('start_date')
            ->unique()
            ->map(function($q){
                return date("Y",strtotime($q));
            });

        $data['count_projects'] = Project::where('create_by',Auth::guard('users')->id())->where("start_date",'like',"%".$request->year."%")->count();
        $data['count_client'] = Client::where('create_by',Auth::guard('users')->id())->where("created_at",'like',"%".$request->year."%")->count();
        $data['count_budget'] = Project::where('create_by',Auth::guard('users')->id())->where("start_date",'like',"%".$request->year."%")->sum('budget');
        $data['count_task'] = Task::where('create_by',Auth::guard('users')->id())->where("start_date",'like',"%".$request->year."%")->count();
        $data['count_task_completed'] = Task::where('create_by',Auth::guard('users')->id())->where("start_date",'like',"%".$request->year."%")->where('status_id',3)->count();
        $data['count_plan_hours'] = Project::where('create_by',Auth::guard('users')->id())->where("start_date",'like',"%".$request->year."%")->sum('plan_hours');
        $data['tasks'] = $this->tasks->tasks($request);
        $data['task_completed'] = $this->tasks->task_completed($request);
        $data['priority_chart'] = $this->priority_chart->executive_chart($request);
        $data['complexity_chart'] = $this->complexity_chart->executive_chart($request);
        return view('users.dashboard.executive',$data);
    }
}


