<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Complexity;
use App\Models\Employee;
use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Services\Users\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    protected $project;
    public function __construct(ProjectService $project)
    {
        $this->project = $project;
    }

    public function index()
    {
        $data['projects'] = Project::where('create_by',Auth::guard('users')->id())->get();
        $data['managers'] = Employee::where('create_by',Auth::guard('users')->id())->get();
        $data['clients'] = Client::where('create_by',Auth::guard('users')->id())->get();
        $data['complexitys'] = Complexity::get();
        $data['prioritys'] = Priority::get();
        $data['statuss'] = Status::get();
        return view('users.project.index',$data);
    }

    public function detail($id)
    {
        $data['project'] = Project::find($id);
        $data['managers'] = Employee::where('create_by',Auth::guard('users')->id())->get();
        $data['clients'] = Client::where('create_by',Auth::guard('users')->id())->get();
        $data['complexitys'] = Complexity::get();
        $data['prioritys'] = Priority::get();
        $data['statuss'] = Status::get();
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
