<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\PaySalary;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    // Add advance salary Method
    public function AddAdvSalary()
    {
        $employee = Employee::latest()->get();

        return view('backend.salary.add_advance_salary', compact('employee'));

    } // End Method

    // Store advacne salary Method
    public function StoreAdvSalary(Request $request)
    {
        $validateData = $request->validate([
            'month' => 'required',
            'year' => 'required',
        ]);
        $month = $request->month;
        $employeeId = $request->employeeId;

        $advanced = AdvanceSalary::where('month', $month)->where('employee_id', $employeeId)->first();

        // condition for no data
        if($advanced === NULL){

            AdvanceSalary::insert([
                'employee_id' => $request->employeeId,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advSalary,
                'created_at' => Carbon::now(),
            ]);
            $noti = [
                'message' => 'Advance Salary Paid Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($noti);
        }else{
            $noti = [
                'message' => 'Advance Already Paid',
                'alert-type' => 'warning',
            ];
            return redirect()->back()->with($noti);
        }

    } // End Method

    // All Advance Salary Method
    public function AllAdvSalary(){
        $salary = AdvanceSalary::latest()->get();
        return view('backend.salary.all_advance_salary',compact('salary'));
    }// End Method

    // Edit Advance Salary Method
    public function EditAdvSalary($id){
        $employee = Employee::latest()->get();
        $advSalary = AdvanceSalary::findOrFail($id);
        return view('backend.salary.edit_advance_salary',compact('advSalary','employee'));
    } // End Method

    // Update Advance Salary Method
    public function UpdateAdvSalary(Request $request){
        $salaryId = $request->id;

        AdvanceSalary::findOrFail($salaryId)->update([
            'employee_id' => $request->employeeId,
            'month' => $request->month,
            'year' => $request->year,
            'advance_salary' => $request->advSalary,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'Advance Salary Update Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#advSalary')->with($noti);

    } // End Method


    // Delete Advance Salary Method
    public function DeleteAdvSalary($id){
        AdvanceSalary::findOrFail($id)->delete();
        $noti = [
            'message' => 'Advance Salary Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#advSalary')->with($noti);
    }// End Method

    ///////////Pay Salary All Method/////////////////////

    public function PaySalary(){
        $employee = Employee:: latest()->get();
        return view('backend.salary.pay_salary',compact('employee'));
    } // End Method

    // Pay Now Method
    public function PayNow($id){
        $paySalary = Employee::findOrFail($id);
        return view('backend.salary.paid_salary',compact('paySalary'));
    } // End Method

    // Paid Employee Salary store in db Method
    public function PaidSalary (Request $request){
        $employeeId = $request->id;

        PaySalary::insert([
            'employee_id' => $employeeId,
            'salary_month' => $request->month,
            'paid_amount' => $request->salary,
            'advance_salary' => $request->advSalary,
            'due_salary' => $request->dueSalary,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'Employee Salary Paid Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('pay#Salary')->with($noti);
    } // End Method

    //Month Salary Method
    public function MonthSalary(){
        $paidSalary = PaySalary::latest()->get();
        return view('backend.salary.month_salary',compact('paidSalary'));
    } // End Method
}
