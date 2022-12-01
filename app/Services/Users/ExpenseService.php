<?php
namespace App\Services\Users;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExpenseService{
    
    function store($request){
        $expense = new Expense();
        $expense->date = $request->date;
        $expense->description = $request->description;
        $expense->reference_number = $request->reference_number;
        $expense->amount = $request->amount;
        $expense->remarks = $request->remarks;
        $expense->project_id = $request->project_id;
        $expense->create_by = Auth::guard('users')->id();
        $expense->save();
    }

    function update($request){
        $expense = Expense::find($request->id);
        $expense->date = $request->date;
        $expense->description = $request->description;
        $expense->reference_number = $request->reference_number;
        $expense->amount = $request->amount;
        $expense->remarks = $request->remarks;
        $expense->project_id = $request->project_id;
        $expense->create_by = Auth::guard('users')->id();
        $expense->save();
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