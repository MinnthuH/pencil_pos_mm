<?php

namespace App\Http\Controllers;

use App\Models\Deli;
use Illuminate\Http\Request;

class DeliController extends Controller
{
    // All deli method
    public function AllDeli()
    {
        $delis = Deli::latest()->get();
        return view('backend.deli.all_deli', compact('delis'));
    } // End All deli method

    // Add deli method
    public function AddDeli()
    {
        return view('backend.deli.add_deli');
    } // End Add deli method

    // Store Deli Method
    public function StoreDeli(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|max:12',
            'address' => 'required',
        ]);

        Deli::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $noti = [
            'message' => 'Deli အသစ်ထည့်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.deli')->with($noti);

    } // End Deli Method

    // Edit deli method
    public function EditDeli($id)
    {
        $deli = Deli::findOrFail($id);
        return view('backend.deli.edit_deli', compact('deli'));
    } // End Edit deli method

    // Update deli Method
    public function UpdateDeli(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|max:12',
            'address' => 'required',
        ]);

        Deli::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,

        ]);
        $noti = [
            'message' => 'Deli ပြင်ဆင်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.deli')->with($noti);

    } // End Update deli Method

    // Delete deli Method
    public function DeleteDeli($id){
        Deli::findOrFail($id)->delete();

        $noti = [
            'message' => 'Deli ပယ်ဖျက်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.deli')->with($noti);

    } // End Deli Method
}
