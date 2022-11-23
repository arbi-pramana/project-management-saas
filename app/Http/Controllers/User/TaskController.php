<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Complexity;
use App\Models\Employee;
use App\Models\Milestone;
use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Services\Users\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $task;
    public function __construct(TaskService $task)
    {
        $this->task = $task;
    }

    public function index($id)
    {
        $data['project'] = Project::find($id);
        $data['employees'] = Employee::get();
        $data['statuss'] = Status::get();
        $data['complexitys'] = Complexity::get();
        $data['prioritys'] = Priority::get();
        $data['tasks'] = Task::where('project_id',$id)->get();
        $data['milestones'] = Milestone::where('project_id',$id)->get();
        return view('users.task.index',$data);
    }

    public function store(Request $request)
    {
        $this->task->store($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function update(Request $request)
    {
        $this->task->update($request);
        return redirect()->back()->with('success','Data has been Updated');
    }

    public function destroy(Request $request)
    {
        Task::find($request->id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}
