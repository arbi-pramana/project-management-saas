<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Project;
use App\Models\User;
use App\Services\Users\IncomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    protected $income;
    public function __construct(IncomeService $income)
    {
        $this->income = $income;
    }

    public function index($id)
    {
        $data['project'] = Project::find($id);
        $data['incomes'] = Income::where('project_id',$id)->orderBy('date','DESC')->get();
        return view('users.income.index',$data);
    }

    public function store(Request $request)
    {
        if($this->maximum()){
            return redirect()->back()->with('danger','Your Income is Maximum, Please Updgrade Your Plan');
        };
        $this->income->store($request);
        return redirect()->back()->with('success','Data has been Added');
    }

    public function update(Request $request)
    {
        $this->income->update($request);
        return redirect()->back()->with('success','Data has been Updated');
    }

    public function destroy(Request $request)
    {
        Income::find($request->id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }

    public function maximum()
    {
        $user = User::find(Auth::guard('users')->id());
        $income = Income::where('create_by',Auth::guard('users')->id())->count();
        if($income >= $user->user_plan->max_incomes){
            return true;
        }
    }
}