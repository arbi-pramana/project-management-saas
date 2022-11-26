<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Users\ResourcesCharts\HoursChartService;
use App\Services\Users\ResourcesCharts\TaskChartService;
use Illuminate\Http\Request;

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
        return view('users.dashboard.resources',$data);
    }
}
