<?php

namespace App\Services\Users\ProjectCharts;

use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;

class IncomeExpenseChartService{
    
    public function chart($id)
    {
        $incomes = Income::where('project_id',$id)->get()
            ->groupBy(function($q){
                return Carbon::parse($q->date)->format('M Y');
            });

        foreach ($incomes as $i => $income) {
            $label[] = $i;
            $income_value[] = $income->sum('paid');
        }
        
        //label
        $data['label'] = $label ?? null;
        $data['income_value'] = $income_value ?? null;

        $expenses = Expense::where('project_id',$id)->get()
            ->groupBy(function($q){
                return Carbon::parse($q->date)->format('M Y');
            });
        
        foreach ($expenses as $i => $expense) {
            $expense_label[] = $i;
            $expense_value[] = $expense->sum('amount');
        }
        $data['expense_value'] = $expense_value ?? null;
        return $data;
    }
}