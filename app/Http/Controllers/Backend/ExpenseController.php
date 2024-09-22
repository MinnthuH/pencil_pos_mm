<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    // Add Expense Method
    public function AddExpense(){

        return view('backend.expense.add_expense');
    } // End Method

    // Stroe Expense Method
    public function StroeExpense(Request $request){
        Expense::insert([
            'details' => $request->deatil,
            'amount' => $request->amount,
            'date' => $request->date,
            'month' => $request->month,
            'year' => $request->year,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'Expense Inserted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);
    }// End Method

    // Today Expense Method
    public function TodayExpense(){

        $date = date('d-m-Y');
        $today = Expense::where('date',$date)->get();

        return view('backend.expense.today_expense',compact('today'));

    } // End Method

    // Edit Expense Method
    public function EditExpense($id){
        $expense = Expense::findOrFail($id);
        return view('backend.expense.edit_expense',compact('expense'));
    } // End Method

    // Update Expense Method
    public function UpdateExpense(Request $request){

        $expense_id = $request->id;
        Expense::findOrFail($expense_id)->update([
            'details' => $request->deatil,
            'amount' => $request->amount,
            'date' => $request->date,
            'month' => $request->month,
            'year' => $request->year,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'Expense Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('today#expense')->with($noti);
    }// End Method

    // Month Expense Method
    public function MonthExpense(){

        $month = date('F');
        $monthExpense = Expense::where('month',$month)->get();
        return view('backend.expense.month_expense',compact('monthExpense'));

    }// End Method

    // Year Expense Method
    public function YearExpense(){

        $year = date('Y');
        $yearExpense = Expense::where('year',$year)->get();
        return view('backend.expense.year_expense',compact('yearExpense'));

    }// End Method
}
