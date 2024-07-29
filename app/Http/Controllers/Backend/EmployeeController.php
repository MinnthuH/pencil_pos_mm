<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Carbon\Carbon;
// use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Image;

class EmployeeController extends Controller
{
    // all employee page
    public function AllEmployee()
    {
        $allEmployee = Employee::latest()->get();
        return view('backend.employee.all_employee', compact('allEmployee'));
    } //End method

    // add employee page
    public function AddEmployee()
    {
        return view('backend.employee.add_employee');
    } // End method

    // add employee
    public function StoreEmployee(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:employees|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'salary' => 'required|max:200',
            'vacation' => 'required|max:200',
            'experience' => 'required',
            'photo' => 'required',
            'city' => 'required',
        ],
            [
                'name' => 'ဝန်ထမ်းအမည်ဖြည့်ရန်လိုအပ်ပါသည်',
            ]
        );

        $image = $request->file('photo');
        $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // set photo name (1326491.jpg/png..)
        Image::make($image)->resize(300, 300)->save('upload/employee/' . $nameGen);
        $saveUrl = 'upload/employee/' . $nameGen;

        Employee::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'image' => $saveUrl,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'created_at' => Carbon::now(),

        ]);
        $noti = [
            'message' => 'Employee Add Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#employee')->with($noti);
    } // end method

    // edit employee
    public function EditEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('employee'));
    } // End method

    // update employee
    public function UpdateEmployee(Request $request)
    {
        $employeeId = $request->id;

        if ($request->file('photo')) {

            $image = $request->file('photo');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // set photo name (1326491.jpg/png..)
            Image::make($image)->resize(300, 300)->save('upload/employee/' . $nameGen);
            $saveUrl = 'upload/employee/' . $nameGen;

            Employee::findOrFail($employeeId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'image' => $saveUrl,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            $noti = [
                'message' => 'Employee Update Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all#employee')->with($noti);

        } else {
            Employee::findOrFail($employeeId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            $noti = [
                'message' => 'Employee Update Without Image Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all#employee')->with($noti);
        } // end end else

    } //End method

    // delete employee
    public function DeleteEmployee($id){
        $employeeImg = Employee::findOrFail($id);
        $img = $employeeImg->image;
        unlink($img);

        Employee::findOrFail($id)->delete();

        $noti = [
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#employee')->with($noti);

    } //End method
}
