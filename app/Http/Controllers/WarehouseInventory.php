<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransferStock;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseInventory extends Controller
{
    // Search Inevntory Method
    public function SearchInventory()
    {

        $product = Product::latest()->get();

        return view('backend.warehouse.search_inventory', compact('product'));
    } // End Method

    // All Inventory Method
    public function AllInventory()
    {
        $inventory = Warehouse::latest()->get();
        return view('backend.warehouse.all_inventory', compact('inventory'));
    }

// Add Inventory Method
    public function AddInventory($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.warehouse.add_inventory', compact('product'));
    } // End Method

    // Store Inventory Method
    public function StoreInventory(Request $request)
    {
        Warehouse::insert([
            'product_id' => $request->product_id,
            'buy_date' => $request->buy_date,
            'buy_qty' => $request->buy_qty,
            'buy_price' => $request->buy_price,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'စတို ကုန်ပစ္စည်းအသစ် ထည့်သွင်းခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.inventory')->with($noti);
    } // End Method

    // Edit Inventory Method
    public function EditInventory($id)
    {
        $inventory = Warehouse::findOrFail($id);
        return view('backend.warehouse.edit_inventory', compact('inventory'));
    } // End Method

    // Update Inventory Method
    public function UpdateInventory(Request $request)
    {
        $id = $request->id;

        $product = Warehouse::findOrFail($id);
        $product->update([
            'buy_date' => $request->buy_date,
            'buy_qty' => $request->buy_qty,
            'buy_price' => $request->buy_price,
            'description' => $request->description,
        ]);
        $noti = [
            'message' => 'စတို ကုန်ပစ္စည်းပြင်ဆင်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.inventory')->with($noti);

    } // End Method

    // Delete Inventory Method
    public function DeleteInventory($id)
    {
        Warehouse::findOrFail($id)->delete();
        $noti = [
            'message' => 'စတို ကုန်ပစ္စည်းပြင်ဆင်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.inventory')->with($noti);
    } // End Method

    // Inventory Stock Method
    public function StockInventory()
    {
        $inventory = Warehouse::select('product_id', DB::raw('SUM(buy_qty) as total_buy_qty'))
            ->groupBy('product_id')
            ->orderBy('created_at', 'desc') // Order by the latest created records
            ->get();

        return view('backend.warehouse.inventory_stock', compact('inventory'));
    } // End Method

    // Transfer Stock to shop method
    public function TransferStock(Request $request)
    {
        $productId = $request->productId;
        $qty = $request->transferStock;

        $product = Product::findOrFail($productId);

        $product->product_store += $qty;
        $product->save();

        // Find the corresponding warehouse records for the product
        $warehouseItems = Warehouse::where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Deduct the transferred quantity ($qty) from buy_qty in warehouse records
        $remainingQty = $qty;
        foreach ($warehouseItems as $item) {
            if ($remainingQty > 0) {
                if ($item->buy_qty >= $remainingQty) {
                    $item->buy_qty -= $remainingQty;
                    $item->save();
                    $remainingQty = 0;
                } else {
                    $remainingQty -= $item->buy_qty;
                    $item->buy_qty = 0;
                    $item->save();
                }
            } else {
                break; // No more quantity to deduct
            }
        }

        TransferStock::insert([
            'product_id' => $productId,
            'quantity' => $qty,
            'created_at' => Carbon::now(),
        ]);

        $noti = [
            'message' => 'စတို ပစ္စည်းလွှဲေပြာင်းခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);
    } // End Method

    // All Transfer Stock Record Method
    public function AllTransferRecord()
    {
        $transfer = TransferStock::latest()->get();
        return view('backend.warehouse.all_transfer_record', compact('transfer'));
    } // End Method

    // Delete Transfer Record Method
    public function DeleteTransferRecord($id)
    {
        TransferStock::findOrFail($id)->delete(); // find and delete record
        $noti = [
            'message' => 'Transfer Record Delete Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.transfer.record')->with($noti);
    }

}
