<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use App\Models\TransferStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopController extends Controller
{
    // All Shop
    public function AllShop()
    {
        $shops = Shop::where('id', '!=', 1)->get();
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

    // Shop Stock Method
    public function StockAdjust($id)
    {
        // Ensure shop exists and retrieve its ID
        $shop = Shop::findOrFail($id);
        $shopId = $shop->id;

        // Retrieve ShopProduct records for the given shop where quantity is >= 1
        $shopProducts = ShopProduct::where('shop_id', $shopId)
            ->where('quantity', '>=', 1)  // Only include products with quantity >= 1
            ->get()
            ->keyBy('product_id');

        $shopProductIds = $shopProducts->keys()->toArray();

        // Retrieve products based on the IDs from shopProducts
        $products = Product::whereIn('id', $shopProductIds)
            ->latest()
            ->paginate(12);

        // Add quantity to each product
        foreach ($products as $product) {
            $product->quantity = $shopProducts->get($product->id)->quantity ?? 0;
        }

        // Fetch additional data
        $customers = Customer::latest()->get();
        $categories = Category::latest()->get();
        $shops = Shop::where('id', '!=', $shopId)->get();

        // Return the view with the retrieved data
        return view('shop.stock_adjust', compact('products', 'customers', 'categories', 'shopProducts', 'shops', 'shop'));
    }

    // End Method

    // Create Stock Adjust
    public function CreateAdjust(Request $request)
    {

        $id = $request->originalShop;
        $orgShopName = Shop::where('id', $id)->first();
        $cartItem = Cart::content();
        $shopId = $request->shopId;
        $shop = Shop::where('id', $shopId)->first();

        // dd($cartItem->toArray());

        return view('shop.create_adjust', compact('shop', 'cartItem', 'orgShopName'));

    } // End Method

// Create Stock Adjust
public function AddTransferStock(Request $request)
{
    $shopId = $request->shopId;
    $orgShopId = $request->orgShopId;
    $cartItems = Cart::content();

    // Start the database transaction
    DB::beginTransaction();

    try {
        // Loop through each cart item to adjust stock
        foreach ($cartItems as $item) {
            $productId = $item->id;
            $qty = $item->qty;

            // Check for insufficient stock in the original shop
            $originalShopProduct = ShopProduct::where('shop_id', $orgShopId)
                ->where('product_id', $productId)
                ->firstOrFail();

            if ($originalShopProduct->quantity < $qty) {
                throw new \Exception('Insufficient stock for product ID ' . $productId . ' in the original shop.');
            }

            if ($shopId == 1) {
                // Adjust the product_store in Product model
                $product = Product::findOrFail($productId);
                $product->product_store += $qty;
                $product->save();

                // Reduce stock from the original shop
                $originalShopProduct->quantity -= $qty;
                $originalShopProduct->save();

                // Insert the transfer stock record
                TransferStock::create([
                    'from_shop_id' => $orgShopId,
                    'to_shop_id' => $shopId,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'created_at' => Carbon::now(),
                ]);

            } else {
                // Reduce stock from the original shop
                $originalShopProduct->quantity -= $qty;
                $originalShopProduct->save();

                // Check if the product exists in the destination shop
                $shopProduct = ShopProduct::where('shop_id', $shopId)
                    ->where('product_id', $productId)
                    ->first();

                if ($shopProduct) {
                    // Check for insufficient stock in the destination shop
                    if ($shopProduct->quantity < $qty) {
                        throw new \Exception('Insufficient stock for product ID ' . $productId . ' in the destination shop.');
                    }

                    $shopProduct->quantity += $qty;
                    $shopProduct->save();
                } else {
                    // Create a new record if the product doesn't exist in the destination shop
                    ShopProduct::create([
                        'shop_id' => $shopId,
                        'product_id' => $productId,
                        'quantity' => $qty,
                    ]);
                }

                // Insert the transfer stock record
                TransferStock::create([
                    'from_shop_id' => $orgShopId,
                    'to_shop_id' => $shopId,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        // Clear the cart after transferring the stock
        Cart::destroy();

        // Commit the transaction
        DB::commit();

        $noti = [
            'message' => 'Product Adjustment Successful',
            'alert-type' => 'success',
        ];

        return redirect()->route('all#shop')->with($noti);

    } catch (\Exception $e) {
        // Rollback the transaction if something goes wrong
        DB::rollback();

        // Log the error
        Log::error('Stock adjustment failed', ['error' => $e->getMessage()]);

        $noti = [
            'message' => 'Product Adjustment Failed: ' . $e->getMessage(),
            'alert-type' => 'error',
        ];

        return redirect()->route('all#shop')->with($noti);
    }
}
 // End Method

}
