<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Refurn;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefurnController extends Controller
{
    // Refurn Route
    public function RefurnSale($id)
    {
        // Get the sale record
        $sale = Sale::where('id', $id)->first();

        // Get sale items with product details, and filter out items where the quantity is less than 1
        $saleItem = OrderDetail::with('product')
            ->where('sale_id', $id)
            ->where('quantity', '>=', 1)
            ->orderBy('id', 'DESC')
            ->get();

        return view('refurn.refurn_sale', compact('sale', 'saleItem'));
    }
     // End Method

    // Refurn Sale Method
    public function RefurnStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $saleItemId = $request->saleItemId;
            $returnQty = $request->refurnqty;
            $refurnAmount = $request->refurn_amout;

            // get sale record
            $sale = Sale::findOrFail($request->sale_id);

            // get sale detail
            $saleItem = OrderDetail::where('id', $saleItemId)->firstOrFail();
            $productId = $saleItem->product_id; // assuming there is a product_id in OrderDetail

            // get the shop product record using shop_id and product_id
            $shopProduct = ShopProduct::where('shop_id', $sale->shop_id)
                                        ->where('product_id', $productId)
                                        ->firstOrFail();

            $saleItemQty = $saleItem->quantity - $returnQty; // reduce qty in Orderdetail table
            $saleTotal = $sale->total - $refurnAmount; // reduce total in Sale table
            $updateReturnChange = $sale->return_change + $refurnAmount; // increase return charge in sale table
            $shopProductQty = $shopProduct->quantity + $returnQty; // add return qty to ShopProduct

            // update sale detail
            $saleItem->update([
                'quantity' => $saleItemQty,
                'total' => $saleItem->total - ($saleItem->unit_price * $returnQty),
            ]);

            // update return charge sale
            $sale->update([
                'sub_total' => $saleTotal,
                'total' => $saleTotal,
                'return_change' => $updateReturnChange,
            ]);

            // update quantity in shop_products table
            $shopProduct->update([
                'quantity' => $shopProductQty,
            ]);

            // insert return record
            Refurn::create([
                'sale_id' => $request->sale_id,
                'shop_id' => $sale->shop_id,
                'sale_item_id' => $saleItemId,
                'refurnqty' => $returnQty,
                'refurn_amout' => $refurnAmount,
                'created_at' => Carbon::now(),
            ]);

            DB::commit();

            $noti = [
                'message' => 'Refurn Product Successful',
                'alert-type' => 'success',
            ];
            return redirect()->route('refurn.all')->with($noti);


        } catch (\Exception $e) {
            DB::rollback();
            // Log the error or handle it appropriately
            return back()->with('error', 'An error occurred during the refund process.');
        }
    } // End Method



    // All Refurn Method
    public function RefurnAll()
    {
        $refurnAll = Refurn::latest()->get();

        return view('refurn.refurn_all', compact('refurnAll'));
    }
}
