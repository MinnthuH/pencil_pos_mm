<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ShopProduct;
use App\Models\Transport;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function Pos()
    {
        $shopId = Auth::user()->shop_id;

        // Get the product IDs and their quantities for the given shop
        $shopProducts = ShopProduct::where('shop_id', $shopId)
            ->where('quantity', '>=', 3)
            ->get()
            ->keyBy('product_id');

        $shopProductIds = $shopProducts->keys()->toArray();

        // Get the products with the filtered product IDs
        $products = Product::whereIn('id', $shopProductIds)
            ->where('expire_date', '>', Carbon::now())
            ->latest()
            ->paginate(150); // Change the number '10' to the desired number of products per page

        // Add quantity to each product
        foreach ($products as $product) {
            $product->quantity = $shopProducts->get($product->id)->quantity ?? 0;
        }

        // Fetch other data
        $customers = Customer::latest()->get();
        $categories = Category::latest()->get();
        $transports = Transport::latest()->get();

        // pos page without QR
        // return view('backend.pos.pos_page', compact('products', 'customers', 'categories', 'transports'));


        // pos page with QR
        return view('backend.pos.pos_page_with_qr', compact('products', 'customers', 'categories', 'transports', 'shopProducts'));
    }

    // End Method

    // Search by Category/name/code
    public function GetProductsByCategory(Request $request, $categoryId)
    {
        $shopId = Auth::user()->shop_id;

        // Get the product IDs and their quantities for the given shop and category
        $shopProducts = ShopProduct::where('shop_id', $shopId)
            ->where('quantity', '>=', 3)
            ->get()
            ->keyBy('product_id');

        $shopProductIds = $shopProducts->keys()->toArray();

        $query = Product::where('category_id', $categoryId)
            ->whereIn('id', $shopProductIds)
            ->where('expire_date', '>', Carbon::now())
            ->latest();

        // Handle search
        $searchTerm = $request->input('search');
        if ($searchTerm) {
            $query->where(function ($subquery) use ($searchTerm) {
                $subquery->where('product_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('product_code', 'like', '%' . $searchTerm . '%');
            });
        }

        $products = $query->paginate(20); // Change the number '20' to the desired number of products per page

        // Add quantity to each product
        foreach ($products as $product) {
            $product->quantity = $shopProducts->get($product->id)->quantity ?? 0;
        }

        return response()->json($products);
    }

    // Add Cart Method
    public function AddCart(Request $request)
    {
        // dd($request->toArray());
        $addCard = Cart::add([
            [
                'id' => $request->id,
                'name' => $request->porductName,
                'qty' => $request->qty,
                'price' => $request->price,
                'options' => ['bPrice' => $request->buyPrice],
            ],
        ]);
        $noti = [
            'message' => 'ကုန်ပစ္စည်း ဈေးခြင်းထဲထည့်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);
    } // End Method


    // Update Cart Method
    public function UpdateCart(Request $request, $rowId)
    {

        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);

        $noti = [
            'message' => 'Cart Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);

    } // End Method

    // cart remove method
    public function RemoveCart($rowId)
    {

        Cart::remove($rowId);

        $noti = [
            'message' => 'ဈေးခြင်းထဲမှ ဖယ်ရှားခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);
    } // End Method

    // CreateInvoice Method
    public function CreateInvoice(Request $request)
    {

        $cartItem = Cart::content();
        $customerId = $request->customerId ?? 1;

        $customer = Customer::where('id', $customerId)->first();
        $Capital = Cart::content();
        $totalBuyPrice = 0; // Initialize totalBuyPrice to zero

        foreach ($Capital as $item) {
            $totalBuyPrice += $item->options['bPrice'] * $item->qty;
        }

        // dd($cartItem->toArray());

        return view('backend.invoice.product_invoice', compact('cartItem', 'customer', 'totalBuyPrice'));
    } // End Method

}
