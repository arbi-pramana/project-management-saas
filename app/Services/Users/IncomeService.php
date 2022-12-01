<?php
namespace App\Services\Users;

use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IncomeService{
    
    function store($request){
        $income = new Income();
        $income->invoice_number = $request->invoice_number;
        $income->date = $request->date;
        $income->amount = $request->amount;
        $income->paid = $request->paid;
        $income->remarks = $request->remarks;
        $income->project_id = $request->project_id;
        $income->create_by = Auth::guard('users')->id();
        $income->save();
    }

    function update($request){
        $income = Income::find($request->id);
        $income->invoice_number = $request->invoice_number;
        $income->date = $request->date;
        $income->amount = $request->amount;
        $income->paid = $request->paid;
        $income->remarks = $request->remarks;
        $income->project_id = $request->project_id;
        $income->create_by = Auth::guard('users')->id();
        $income->save();
    }

    public function maximum()
    {
        $user = User::find(Auth::guard('users')->id());
        $income = Income::where('create_by',Auth::guard('users')->id())->count();
        if($income >= $user->user_plan->max_incomes && $income != 0){
            return true;
        }
    }
}