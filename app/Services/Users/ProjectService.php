<?php
namespace App\Services\Users;

use App\Models\Client;
use App\Models\Complexity;
use App\Models\Employee;
use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectService{
    public function index()
    {
        $data['projects'] = Project::where('create_by',Auth::guard('users')->id())->get();
        $data['managers'] = Employee::where('create_by',Auth::guard('users')->id())->get();
        $data['clients'] = Client::where('create_by',Auth::guard('users')->id())->get();
        $data['complexitys'] = Complexity::get();
        $data['prioritys'] = Priority::get();
        $data['statuss'] = Status::get();
        return $data;
    }
    
    public function detail($id)
    {
        $data['project'] = Project::find($id);
        $data['managers'] = Employee::where('create_by',Auth::guard('users')->id())->get();
        $data['clients'] = Client::where('create_by',Auth::guard('users')->id())->get();
        $data['complexitys'] = Complexity::get();
        $data['prioritys'] = Priority::get();
        $data['statuss'] = Status::get();
        $data['tasks'] = Task::where('project_id',$id)->get();
        $data['task_complete'] = $data['tasks']->where('status_id',3); 
        return $data;
    }

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

    public function maximum()
    {
        $user = User::find(Auth::guard('users')->id());
        $project = Project::where('create_by',Auth::guard('users')->id())->count();
        if($project >= $user->user_plan->max_projects && $project != 0){
            return true;
        }
    }
}