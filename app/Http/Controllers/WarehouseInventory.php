<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    }

}
