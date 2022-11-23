<?php
namespace App\Services\Users;

use App\Models\Expense;
use App\Models\Income;
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
}