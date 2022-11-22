<?php
namespace App\Services\Users;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeService{
    
    function store($request){
        $employee = new Employee();
        $employee->code = $request->code;
        $employee->name = $request->name;
        $employee->employee_type_id = $request->employee_type_id;
        $employee->department_id = $request->department_id;
        $employee->create_by = Auth::guard('users')->id();
        $employee->save();
    }

    function update($request){
        $employee = Employee::find($request->id);
        $employee->code = $request->code;
        $employee->name = $request->name;
        $employee->employee_type_id = $request->employee_type_id;
        $employee->department_id = $request->department_id;
        $employee->create_by = Auth::guard('users')->id();
        $employee->save();
    }
}