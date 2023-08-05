<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shop;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    // Shop Info Method
    public function ShopInfo()
    {
        $shopInfo = Shop::first();
        // dd($shopInfo->toArray());
        return view('shop.shop_info', compact('shopInfo'));
    } // End Shop Info Method

    // Shop Info Update Method
    public function ShopInfoUpdate(Request $request)
    {

        $id = $request->id;
        $data = Shop::findOrFail($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->description = $request->descripton;


        if ($request->file('logo')) {
            $file = $request->file('logo');
            @unlink(public_path('upload/shop_logo/'.$data->logo)); // delete image form storage path
            $filename = date('YmdHi') . $file->getClientOriginalName(); // set unique id and name
            $file->move(public_path('upload/shop_logo'), $filename); // store in path with filename
            $data['logo'] = $filename;
        }

        $data->save();
        $noti = [
            'message' => 'ဆိုင်အချက်အလက် အပ်ဒိတ်ပြုလုပ်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('shop#info')->with($noti);

        // if ($request->file('logo')) {
        //     $image = $request->file('logo');
        //     @unlink(public_path('upload/admin_images/' . $request->logo)); // delete image form storage path
        //     $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // set photo name (1326491.jpg/png..)
        //     Image::make($image)->resize(300, 300)->save('upload/shop_logo/' . $nameGen);
        //     $saveUrl = 'upload/shop_logo/' . $nameGen;


        //     Shop::findOrFail($id)->update([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'phone' => $request->phone,
        //         'address' => $request->address,
        //         'logo' => $saveUrl,
        //         'description' => $request->descripton,
        //         'updated_at' => Carbon::now(),
        //     ]);
        //     $noti = [
        //         'message' => 'ဆိုင်အချက်အလက် အပ်ဒိတ်ပြုလုပ်ခြင်း အောင်မြင်ပါသည်',
        //         'alert-type' => 'success',
        //     ];
        //     return redirect()->route('shop#info')->with($noti);
        // } else {
        //     Shop::findOrFail($id)->update([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'phone' => $request->phone,
        //         'address' => $request->address,
        //         'description' => $request->descripton,
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }
        // $noti = [
        //     'message' => 'ဆိုင်အချက်အလက် အပ်ဒိတ်ပြုလုပ်ခြင်း အောင်မြင်ပါသည်',
        //     'alert-type' => 'success',
        // ];
        // return redirect()->route('shop#info')->with($noti);

    }
}
