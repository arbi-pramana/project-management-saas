<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Employee;
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
        TaskChartService $tasks
    ){
        $this->hours = $hours;
        $this->tasks = $tasks;
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
        return view('users.dashboard.resources',$data);
    }
}


