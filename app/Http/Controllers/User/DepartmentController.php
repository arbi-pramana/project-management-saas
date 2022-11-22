<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Services\Users\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    protected $department;
    public function __construct(DepartmentService $department)
    {
        $this->department = $department;
    }

    public function index()
    {
        $data['departments'] = Department::where('create_by',Auth::guard('users')->id())->get();
        return view('users.department.index',$data);
    }

    public function store(Request $request)
    {
        $this->department->store($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function update(Request $request)
    {
        $this->department->update($request);
        return redirect()->back()->with('success','Data has been Updated');
    }

    public function destroy(Request $request)
    {
        Department::find($request->id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}
