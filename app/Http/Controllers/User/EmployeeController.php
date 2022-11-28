<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeType;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Services\Users\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    protected $employee;
    public function __construct(EmployeeService $employee)
    {
        $this->employee = $employee;
    }

    public function index()
    {
        $data['employees'] = Employee::where('create_by',Auth::guard('users')->id())->get();
        $data['emp_types'] = EmployeeType::where('create_by',Auth::guard('users')->id())->get();
        $data['departments'] = Department::where('create_by',Auth::guard('users')->id())->get();
        return view('users.employee.index',$data);
    }

    public function store(Request $request)
    {
        if($this->maximum()){
            return redirect()->back()->with('danger','Your Employee is Maximum, Please Updgrade Your Plan');
        };
        $this->employee->store($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function update(Request $request)
    {
        $this->employee->update($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function destroy(Request $request)
    {
        $task = Task::where('employee_id',$request->id)->count();
        if($task > 0){
            return redirect()->back()->with('danger','Please Delete Relate Task First');
        }
        $project = Project::where('manager',$request->id)->count();
        if($project > 0){
            return redirect()->back()->with('danger','Please Delete Relate Project First');
        }
        Employee::find($request->id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }

    public function maximum()
    {
        $user = User::find(Auth::guard('users')->id());
        $employee = Employee::where('create_by',Auth::guard('users')->id())->count();
        if($employee >= $user->user_plan->max_employees){
            return true;
        }
    }
}
