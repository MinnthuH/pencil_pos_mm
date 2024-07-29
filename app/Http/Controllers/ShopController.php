<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shop;
use App\Models\Product;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use App\Models\TransferStock;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    // All Shop
    public function AllShop()
    {
        $shops = Shop::all();
        return view('shop.all_shop', compact('shops'));
    } // End All Shop

    // Add Shop Method
    public function AddShop()
    {
        return view('shop.add_shop');
    } // End Add Shop Method

    // Store Shop Method
    public function StoreShop(Request $request)
    {
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $filename = date('YmdHi') . $image->getClientOriginalName(); // set unique id and name
            Image::make($image)->resize(300, 300)->save('upload/shop_logo/' . $filename);
            $saveUrl = 'upload/shop_logo/' . $filename;
        }

        Shop::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'logo' => $saveUrl ?? null, // Ensure this is set if logo is not uploaded
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);

        $noti = [
            'message' => 'ဆိုင်အချက်အလက် ထည့်သွင်းခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#shop')->with($noti);
    } // End Store Method

    // Shop Info Method
    public function ShopInfo($id)
    {
        $shopInfo = Shop::findOrFail($id);
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
        $data->description = $request->description; // Corrected the typo

        if ($request->file('logo')) {
            $file = $request->file('logo');
            @unlink(public_path('upload/shop_logo/' . $data->logo)); // Delete the old image from storage path
            $filename = date('YmdHi') . $file->getClientOriginalName(); // Set unique id and name
            $file->move(public_path('upload/shop_logo'), $filename); // Store in path with filename
            $data->logo = $filename; // Ensure the path is correctly set
        }

        $data->save();

        $noti = [
            'message' => 'ဆိုင်အချက်အလက် အပ်ဒိတ်ပြုလုပ်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#shop')->with($noti);
    } // End Shop info Update


    // Shop Delete
    public function ShopDelete($id)
    {
        $data = Shop::findOrFail($id);
        @unlink(public_path('upload/shop_logo/' . $data->logo)); // Delete the old image from storage path
        $data->delete();

        $noti = [
            'message' => 'Shop Delete Successful',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#shop')->with($noti);
    } // End Shop Delete

    // Shop Stock Method
    public function ShopStock($id)
    {
        // Get the shop information
        $shop = Shop::findOrFail($id);

        // Get all stocks where shop_id matches the provided $id
        $stocks = ShopProduct::where('shop_id', $id)->get();

        // dd($stocks->toArray());
        // Return the view with the shop and stocks data
        return view('shop.shop_stock', compact('shop', 'stocks'));
    } // End Method

    // Stock Transfer Method
    public function StockTransfer(Request $request)
{

    $shopId = $request->shopId;
    $productId = $request->productId;
    $qty = $request->transferStock;


    // Find the ShopProduct record
    $shopProduct = ShopProduct::where('shop_id', $shopId)
        ->where('product_id', $productId)
        ->first();
    dd($shopProduct);
    // Check if the ShopProduct record exists
    if ($shopProduct) {
        $quantity = $shopProduct->quantity;
        dd($quantity);
    } else {
        dd('No product found for this shop with the given product ID');
    }
    $product = Product::findOrFail($productId);

    // Reduce stock from main warehouse
    if ($product->product_store < $qty) {
        // Handle the case where there is not enough stock in the main warehouse
        $noti = [
            'message' => 'ကုန်ပစ္စည်းလက်ကျန် မလုံလောက်ပါ',
            'alert-type' => 'error',
        ];
        return redirect()->back()->with($noti);
    }

    $product->product_store -= $qty;
    $product->save();



    // Insert the transfer stock record
    TransferStock::create([
        'shop_id' => $shopId,
        'product_id' => $productId,
        'quantity' => $qty,
        'created_at' => Carbon::now(),
    ]);

    $noti = [
        'message' => 'ဆိုင်သို့ ကုန်ပစ္စည်းလွှဲပြောင်းခြင်း အောင်မြင်ပါသည်',
        'alert-type' => 'success',
    ];
    return redirect()->back()->with($noti);
}

}
