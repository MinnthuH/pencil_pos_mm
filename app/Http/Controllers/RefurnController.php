<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Refurn;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefurnController extends Controller
{
    // Refurn Route
    public function RefurnSale($id)
    {
        $sale = Sale::where('id', $id)->first();
        $saleItem = OrderDetail::with('product')->where('sale_id', $id)->orderBy('id', 'DESC')->get();

        return view('refurn.refurn_sale', compact('sale', 'saleItem'));

    } // End Method

    // Refurn Sale Method
    public function RefurnStore(Request $request)
    {
        // dd($request->all());

        try {

            DB::beginTransaction();

            $saleItemId = $request->saleItemId;
            $retrunqty = $request->refurnqty;
            $refurnAmount = $request->refurn_amout;

            $sale = Sale::findOrFail($request->sale_id); // get sale record

            $saleItem = OrderDetail::where('id', $saleItemId)->first(); // get sale detail

            $product = Product::where('id', $saleItem->product_id)->first(); // get product record

            $updateQty = $product->product_store + $retrunqty;

            $saleItemQty = $saleItem->quantity - $retrunqty; // for reduce qty in Orderdetail table

            $saleTotal = $sale->total - $refurnAmount; // for reduce total in Sale table

            $updateReturnChange = $sale->return_change + $refurnAmount; // for increase return charge in sale table

            // update sale detail
            $saleItem->update([
                'quantity' => $saleItemQty,
                'total' => $saleTotal,
            ]);

            // update return charge sale
            $sale->update([
                'sub_total' => $saleTotal,
                'total' => $saleTotal,
                'return_change' => $updateReturnChange,
            ]);

            // update product qty in product table
            $product->update([
                'product_store' => $updateQty,
            ]);

            Refurn::insert([
                'sale_id' => $request->sale_id,
                'sale_item_id' => $saleItemId,
                'refurnqty' => $retrunqty,
                'refurn_amout' => $refurnAmount,
                'created_at' => Carbon::now(),
            ]);

            DB::commit();
            $noti = [
                'message' => 'Refurn  Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all#sale')->with('noti');

        } catch (\Exception $e) {
            //throw $th;

            DB::rollback();
        }

        // dd($sale);

    }

    // All Refurn Method
    public function RefurnAll()
    {
        $refurnAll = Refurn::latest()->get();

        return view('refurn.refurn_all', compact('refurnAll'));
    }
}
