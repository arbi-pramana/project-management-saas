<?php
namespace App\Services\Users;

use App\Models\EmployeeType;
use Illuminate\Support\Facades\Auth;

class EmployeeTypeService{
    
    function store($request){
        $emp_type = new EmployeeType();
        $emp_type->name = $request->name;
        $emp_type->create_by = Auth::guard('users')->id();
        $emp_type->save();
    }

    function update($request){
        $emp_type = EmployeeType::find($request->id);
        $emp_type->name = $request->name;
        $emp_type->create_by = Auth::guard('users')->id();
        $emp_type->save();
    }
}