<?php
namespace App\Services\Users;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectService{
    public function store($request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->manager = $request->manager;
        $project->client_id = $request->client_id;
        $project->budget = $request->budget;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->complexity_id = $request->complexity_id;
        $project->priority_id = $request->priority_id;
        $project->status_id = $request->status_id;
        $project->plan_hours = $request->plan_hours;
        $project->create_by = Auth::guard('users')->id();
        $project->save();
    }

    public function update($request)
    {
        $project = Project::find($request->id);
        $project->name = $request->name;
        $project->manager = $request->manager;
        $project->client_id = $request->client_id;
        $project->budget = $request->budget;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->complexity_id = $request->complexity_id;
        $project->priority_id = $request->priority_id;
        $project->status_id = $request->status_id;
        $project->plan_hours = $request->plan_hours;
        $project->create_by = Auth::guard('users')->id();
        $project->save();
    }
}