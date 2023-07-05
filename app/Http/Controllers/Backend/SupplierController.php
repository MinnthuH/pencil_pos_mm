<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class SupplierController extends Controller
{
    // All Supplier Method
    public function AllSupplier(){
        $allSupplier = Supplier::latest()->get();
        return view('backend.supplier.all_supplier',compact('allSupplier'));
    }// End Method

    // Add Supplier Method
    public function AddSupplier(){
        return view('backend.supplier.add_supplier');
    }// End Method

      // store customer method
      public function storeSupplier(Request $request){

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
            'type' => 'required',
        ],
            [
                'name' => 'ဝန်ထမ်းအမည်ဖြည့်ရန်လိုအပ်ပါသည်',
            ]
        );

        $image = $request->file('image');
        $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // set photo name (1326491.jpg/png..)
        Image::make($image)->resize(300, 300)->save('upload/supplier/' . $nameGen);
        $saveUrl = 'upload/supplier/' . $nameGen;

        Supplier::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->accholder,
            'account_number' => $request->accnumber,
            'image' => $saveUrl,
            'bank_name' => $request->bankname,
            'bank_branch' => $request->bankbranch,
            'city' => $request->city,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'Supplier Add Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#supplier')->with($noti);
    } // End Method

     // Edit Supplier Method
     public function EditSupplier($id){
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit_supplier',compact('supplier'));
    } // End Method

     // Update Supplier Method
     public function UpdateSupplier(Request $request){

        $supplerId = $request->id;

        if ($request->file('image')) {

            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // set photo name (1326491.jpg/png..)
            Image::make($image)->resize(300, 300)->save('upload/supplier/' . $nameGen);
            $saveUrl = 'upload/supplier/' . $nameGen;

            Supplier::findOrFail($supplerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->accholder,
                'account_number' => $request->accnumber,
                'image' => $saveUrl,
                'bank_name' => $request->bankname,
                'bank_branch' => $request->bankbranch,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            $noti = [
                'message' => 'Supplier Update Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all#supplier')->with($noti);

        } else {
            Supplier::findOrFail($supplerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->accholder,
                'account_number' => $request->accnumber,
                'bank_name' => $request->bankname,
                'bank_branch' => $request->bankbranch,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
            $noti = [
                'message' => 'Supplier Update Without Image Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all#supplier')->with($noti);
        } // end end else
    }// End Method

     // Delete Supplier Method
     public function DeleteSupplier($id){
        $supplierImg = Supplier::find($id);
        $Img = $supplierImg->image;
        unlink($Img);

        Supplier::findOrFail($id)->delete();
        $noti = [
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#supplier')->with($noti);

    } // End Method

    // Detail Supplier Method
    public function DetailSupplier($id){
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.detail_supplier',compact('supplier'));

    } // End Method
}
