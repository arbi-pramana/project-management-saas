<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Users\ResourcesCharts\HoursChartService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $hours;
    public function __construct(HoursChartService $hours)
    {
        $this->hours = $hours;
    }

    public function index()
    {
        return view('users.dashboard.index');
    }

    public function resources(Request $request)
    {
        $data['hours'] = $this->hours->chart();
        return view('users.dashboard.resources',$data);
    }
}
