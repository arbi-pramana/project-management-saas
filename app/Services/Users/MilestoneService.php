<?php
namespace App\Services\Users;

use App\Models\Milestone;
use Illuminate\Support\Facades\Auth;

class MilestoneService{
    
    function store($request){
        $milestone = new Milestone();
        $milestone->name = $request->name;
        $milestone->project_id = $request->project_id;
        $milestone->create_by = Auth::guard('users')->id();
        $milestone->save();
    }

    function update($request){
        $milestone = Milestone::find($request->id);
        $milestone->name = $request->name;
        $milestone->project_id = $request->project_id;
        $milestone->create_by = Auth::guard('users')->id();
        $milestone->save();
    }
}