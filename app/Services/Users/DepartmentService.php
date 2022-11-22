<?php
namespace App\Services\Users;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentService{
    
    function store($request){
        $department = new Department();
        $department->name = $request->name;
        $department->create_by = Auth::guard('users')->id();
        $department->save();
    }

    function update($request){
        $department = Department::find($request->id);
        $department->name = $request->name;
        $department->create_by = Auth::guard('users')->id();
        $department->save();
    }
}