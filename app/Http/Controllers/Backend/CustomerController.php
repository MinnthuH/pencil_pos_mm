<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class CustomerController extends Controller
{
    // All Coustomer
    public function AllCustomer(){
        $allCustomer = Customer::latest()->get();
        return view('backend.customer.all_customer',compact('allCustomer'));
    }// End Method

    // add Customer method
    public function AddCustomer(){
        return view('backend.customer.add_customer');
    } // End Method

    // store customer method
    public function storeCustomer(Request $request){

        $validate = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:customers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'accholder' => 'required|max:200',
            'accnumber' => 'required|max:200',
            'image' => 'required',
            'city' => 'required',
        ]

        );

        $image = $request->file('image');
        $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // set photo name (1326491.jpg/png..)
        Image::make($image)->resize(300, 300)->save('upload/customer/' . $nameGen);
        $saveUrl = 'upload/customer/' . $nameGen;

        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->accholder,
            'account_number' => $request->accnumber,
            'image' => $saveUrl,
            'bank_name' => $request->bankname,
            'bank_branch' => $request->bankbranch,
            'city' => $request->city,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'ဖေါက်သည် အသစ်ထည့်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#customer')->with($noti);
    } // End Method

    // Edit Customer Method
    public function EditCustomer($id){
        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit_customer',compact('customer'));
    } // End Method

    // Update Customer Method
    public function UpdateCustomer(Request $request){

        $customerId = $request->id;

        if ($request->file('image')) {

            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // set photo name (1326491.jpg/png..)
            Image::make($image)->resize(300, 300)->save('upload/customer/' . $nameGen);
            $saveUrl = 'upload/customer/' . $nameGen;

            Customer::findOrFail($customerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->accholder,
                'account_number' => $request->accnumber,
                'image' => $saveUrl,
                'bank_name' => $request->bankname,
                'bank_branch' => $request->bankbranch,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            $noti = [
                'message' => 'ဖေါက်သည် အချက်အလက်ပြင်ဆင်ခြင်း အောင်မြင်ပါသည်',
                'alert-type' => 'success',
            ];
            return redirect()->route('all#customer')->with($noti);

        } else {
            Customer::findOrFail($customerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->accholder,
                'account_number' => $request->accnumber,
                'bank_name' => $request->bankname,
                'bank_branch' => $request->bankbranch,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            $noti = [
                'message' => 'Customer Update Without Image Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all#customer')->with($noti);
        } // end end else
    }// End Method

    // Delete Customer Method
    public function DeleteCustomer($id){
        $csutomerImg = Customer::find($id);
        $Img = $csutomerImg->image;
        unlink($Img);

        Customer::findOrFail($id)->delete();
        $noti = [
            'message' => 'ဖေါက်သည် ဖျက်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#customer')->with($noti);

    } // End Method
}
