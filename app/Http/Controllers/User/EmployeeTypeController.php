<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\EmployeeType;
use App\Services\Users\EmployeeTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeTypeController extends Controller
{
    protected $emp_type;
    public function __construct(EmployeeTypeService $emp_type)
    {
        $this->emp_type = $emp_type;
    }

    public function index()
    {
        $data['employee_types'] = EmployeeType::where('create_by',Auth::guard('users')->id())->get();
        return view('users.employee-type.index',$data);
    }

    public function store(Request $request)
    {
        $this->emp_type->store($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function update(Request $request)
    {
        $this->emp_type->update($request);
        return redirect()->back()->with('success','Data has been Updated');
    }

    public function destroy(Request $request)
    {
        EmployeeType::find($request->id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}
