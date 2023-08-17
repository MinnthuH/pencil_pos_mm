<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Deli;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    // POS Dashboard Method
    public function Pos()
    {

        $products = Product::where('expire_date', '>', Carbon::now())
        ->where('product_store', '>',0)->latest()->get();
        $customers = Customer::latest()->get();
        $categories = Category::latest()->get();
        $delis = Deli::latest()->get();
        return view('backend.pos.pos_page', compact('products', 'customers', 'categories','delis'));
    } // End Method


    public function GetProductsByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)
            ->where('product_store', '>',0)
            ->where('expire_date', '>', Carbon::now())->latest()->get();
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
                'options' => ['bPrice' => $request->buyPrice]
            ],
        ]);
        $noti = [
            'message' => 'ကုန်ပစ္စည်း ဈေးခြင်းထဲထည့်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);
    } // End Method

    // // All Item Method
    // public function AllItem()
    // {

    //     $productItem = Cart::content();
    //     return view('backend.pos.text_item', compact('productItem'));
    // } // End Mehtod

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
        $customerId = $request->customerId;
        $deliId = $request->deliId;
        $deli = Deli::where('id', $deliId)->first();
        $customer = Customer::where('id', $customerId)->first();
        $Capital = Cart::content();
        $totalBuyPrice = 0; // Initialize totalBuyPrice to zero

        foreach ($Capital as $item) {
            $totalBuyPrice += $item->options['bPrice'] * $item->qty;
        }

        // dd($cartItem->toArray());

        return view('backend.invoice.product_invoice', compact('cartItem', 'customer', 'totalBuyPrice','deli'));
    } // End Method


}
