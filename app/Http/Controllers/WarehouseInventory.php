<?php

namespace App\Http\Controllers;

use App\Exports\DailyTransferExport;
use App\Exports\WarehouseStockExport;
use App\Exports\WeeklyTransferExport;
use App\Imports\StockTransferImport;
use App\Imports\WarehouseStockImport;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopProduct;
use App\Models\TransferStock;
use App\Models\Warehouse;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

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
        $inventory = Product::latest()->get();

        $shops = Shop::latest()->get();

        return view('backend.warehouse.inventory_stock', compact('inventory', 'shops'));
    } // End Method

    // Transfer Stock to shop method
    public function TransferStock(Request $request)
    {

        $shopId = $request->shopId;
        $productId = $request->productId;
        $qty = $request->transferStock;

        $product = Product::findOrFail($productId);

        // Reduce stock from main warehouse
        $product->product_store -= $qty;
        $product->save();

        // Update or create the shop product record
        $shopProduct = ShopProduct::updateOrCreate(
            [
                'shop_id' => $shopId,
                'product_id' => $productId,
            ],
            [
                'quantity' => DB::raw('quantity + ' . $qty),
                'created_at' => Carbon::now(),
            ]
        );

        // Insert the transfer stock record
        TransferStock::create([
            'shop_id' => $shopId,
            'product_id' => $productId,
            'quantity' => $qty,
            'created_at' => Carbon::now(),
        ]);

        $noti = [
            'message' => 'ဆိုင်သို့ ကုန်ပစ္စည်းလွှဲေပြာင်းခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);
    }

    // All Transfer Stock Record Method
    public function AllTransferRecord()
    {
        $transfer = TransferStock::select(
            'shop_id',
            'product_id',
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(quantity) as total_quantity')
        )
            ->groupBy('shop_id', 'product_id', DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc')
            ->get();

        // Load related models
        $transfer->load('shop', 'product');

        return view('backend.warehouse.all_transfer_record', compact('transfer'));
    } // End Method

    // Delete Transfer Record
    public function deleteRecord(Request $request)
    {

        // Debugging statement
        \Log::info('Delete request received', $request->all());

        $shopId = $request->shop_id;
        $productId = $request->product_id;
        $date = $request->date;

        $startDate = Carbon::parse($date)->startOfDay();
        $endDate = Carbon::parse($date)->endOfDay();

        // Delete the records
        $deleted = TransferStock::where('shop_id', $shopId)
            ->where('product_id', $productId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->delete();

        if ($deleted) {
            $noti = [
                'message' => 'Transfer record deleted successfully.',
                'alert-type' => 'success',
            ];
        } else {
            $noti = [
                'message' => 'No record found to delete.',
                'alert-type' => 'warning',
            ];
        }

        return redirect()->route('all.transfer.record')->with($noti);
    }

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

    // Transfer to shop with file
    public function MassTransfer()
    {
        $shops = Shop::latest()->get();

        $products = Product::where('expire_date', '>', Carbon::now())
            ->whereColumn('product_store', '>=', 'product_track')
            ->latest()
            ->paginate(10); // Change the number '10' to the desired number of products per page
        // dd($products);

        $categories = Category::latest()->get();

        return view('backend.warehouse.stocks_tranfer', compact('products', 'categories', 'shops'));

    } // End Method

    // Import Transfer Shop with file
    public function ImportStockTransfer(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
            'shopId' => 'required|integer',
        ]);

        $shopId = $request->shopId;

        Excel::import(new StockTransferImport($shopId), $request->file('file'));

        $noti = [
            'message' => 'ကုန်ပစ္စည်း Stock ဖိုင်ဖြင့်ထည့်သွင်းခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('stock.inventory')->with($noti);
    }

// Export Warehouse Stock with file
    public function ExportStock()
    {
        return Excel::download(new WarehouseStockExport, 'warehouse_stocks.xlsx');
    } // End Method

    // Import Stock to Warehouse Method
    public function StockImport()
    {

        return view('backend.warehouse.stock_import');

    } // End Method

    // Import Warehouse with file
    public function ImportStock(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
        // dd("here");
        try {
            DB::transaction(function () use ($request) {
                Excel::import(new WarehouseStockImport, $request->file('file'));
            });

            $noti = [
                'message' => 'ကုန်ပစ္စည်း Stock ဖိုင်ဖြင့်ထည့်သွင်းခြင်း အောင်မြင်ပါသည်',
                'alert-type' => 'success',
            ];
            return redirect()->route('stock.inventory')->with($noti);
        } catch (Exception $e) {
            Log::error('Error during import: ', ['message' => $e->getMessage()]);
            return redirect()->route('stock.inventory')->with('error', 'There was an error updating the product store data.');
        }
    }

    // Stock Add Cart Method
    public function StockAddCart(Request $request)
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

    // Update Stock Cart Method
    public function StockUpdateCart(Request $request, $rowId)
    {

        $qty = $request->qty;
        $update = Cart::update($rowId, $qty);

        $noti = [
            'message' => 'Cart Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);

    } // End Method

    // Stock cart remove method
    public function StockRemoveCart($rowId)
    {

        Cart::remove($rowId);

        $noti = [
            'message' => 'Prodcut Remove Successful',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);
    } // End Method

    // CreateInvoice Method
    public function CraeateTransferOrder(Request $request)
    {

        $cartItem = Cart::content();
        $shopId = $request->shopId;
        $shop = Shop::where('id', $shopId)->first();

        // dd($cartItem->toArray());

        return view('backend.warehouse.stock_transfer_order', compact('shop', 'cartItem'));

    } // End Method

    // Add Transfer Stock

    public function AddTransferStock(Request $request)
    {

        $shopId = $request->shopId;
        $cartItems = Cart::content();

        foreach ($cartItems as $item) {
            $productId = $item->id;
            $qty = $item->qty;

            $product = Product::findOrFail($productId);

            // Reduce stock from main warehouse
            $product->product_store -= $qty;
            $product->save();

            // Update or create the shop product record
            ShopProduct::updateOrCreate(
                [
                    'shop_id' => $shopId,
                    'product_id' => $productId,
                ],
                [
                    'quantity' => DB::raw('quantity + ' . $qty),
                    'created_at' => Carbon::now(),
                ]
            );

            // Insert the transfer stock record
            TransferStock::create([
                'shop_id' => $shopId,
                'product_id' => $productId,
                'quantity' => $qty,
                'created_at' => Carbon::now(),
            ]);
        }

        // Clear the cart after transferring the stock
        Cart::destroy();

        $noti = [
            'message' => 'ဆိုင်သို့ ကုန်ပစ္စည်းလွှဲပြောင်းခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('mass.transfer')->with($noti);
    } // End Method

    // Trasnfer Record export daily
    public function exportDaily()
    {
        return Excel::download(new DailyTransferExport, 'daily_transfer.xlsx');
    }
    // Trasnfer Record export weekly

    public function exportWeekly()
    {
        return Excel::download(new WeeklyTransferExport, 'weekly_transfer.xlsx');
    }
}
