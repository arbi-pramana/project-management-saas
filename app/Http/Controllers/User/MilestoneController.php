<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Milestone;
use App\Models\Project;
use App\Services\Users\MilestoneService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{
    protected $milestone;
    public function __construct(MilestoneService $milestone)
    {
        $this->milestone = $milestone;
    }

    public function index($id)
    {
        $data['project'] = Project::find($id);
        $data['milestones'] = Milestone::where('project_id',$id)->get();
        return view('users.milestone.index',$data);
    }

    public function store(Request $request)
    {
        $this->milestone->store($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function update(Request $request)
    {
        $this->milestone->update($request);
        return redirect()->back()->with('success','Data has been Updated');
    }

    public function destroy(Request $request)
    {
        Milestone::find($request->id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}
