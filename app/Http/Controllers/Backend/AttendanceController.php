<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Attendance List Method
    public function AttendanceList()
    {
        $allAttendanceList = Attendence::select('date')->groupBy('date')->orderBy('id', 'desc')->get();
        return view('backend.attendance.all_attendance_list', compact('allAttendanceList'));
    } // End Method

    // Add Attendance page Method
    public function AddAttendance()
    {
        $employees = Employee::all();
        return view('backend.attendance.add_attendance', compact('employees'));
    } //End Method

    // Store Employee Attendance Method
    public function StoreAttendance(Request $request)
    {
        Attendence::where('date',date('Y-m-d',strtotime($request->date)))->delete();

        $countemployee = count($request->employee_id);

        for ($i = 0; $i < $countemployee; $i++) {
            $attendStatus = 'attend_status' . $i;
            $attend = new Attendence();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attendStatus;
            $attend->save();
        }
        $noti = [
            'message' => 'Data Inserted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('employee#attendance')->with($noti);

    } // End Method

    // Edit Attendance page Method
    public function EditAttendance($date)
    {
        $employees = Employee::all();
        $editData = Attendence::where('date',$date)->get();
        return view('backend.attendance.edit_attendance', compact('employees','editData'));

    } //End Method

    // View Attendence Method
    public function ViewAttendance($date){

        $detailAttend = Attendence::where('date',$date)->get();
        return view('backend.attendance.detail_attendance', compact('detailAttend'));

    } //End Method
}
