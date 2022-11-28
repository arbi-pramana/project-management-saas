<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Project;
use App\Models\User;
use App\Services\Users\ExpenseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    protected $expense;
    public function __construct(ExpenseService $expense)
    {
        $this->expense = $expense;
    }

    public function index($id)
    {
        $data['project'] = Project::find($id);
        $data['expenses'] = Expense::where('project_id',$id)->orderBy('date','DESC')->get();
        return view('users.expense.index',$data);
    }

    public function store(Request $request)
    {
        if($this->maximum()){
            return redirect()->back()->with('danger','Your Expense is Maximum, Please Updgrade Your Plan');
        };
        $this->expense->store($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function update(Request $request)
    {
        $this->expense->update($request);
        return redirect()->back()->with('success','Data has been Updated');
    }

    public function destroy(Request $request)
    {
        Expense::find($request->id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }

    public function maximum()
    {
        $user = User::find(Auth::guard('users')->id());
        $expense = Expense::where('create_by',Auth::guard('users')->id())->count();
        if($expense >= $user->user_plan->max_expenses && $expense != 0){
            return true;
        }
    }
}
