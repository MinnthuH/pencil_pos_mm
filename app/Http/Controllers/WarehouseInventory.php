<?php

namespace App\Http\Controllers;

use App\Exports\DailyStockinExport;
use App\Exports\DailyTransferExport;
use App\Exports\WarehouseStockExport;
use App\Exports\WeeklyStockinExport;
use App\Exports\WeeklyTransferExport;
use App\Imports\StockTransferImport;
use App\Imports\WarehouseStockImport;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopProduct;
use App\Models\StockIn;
use App\Models\TransferStock;
use App\Models\Warehouse;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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

        $shops = Shop::where('id', '!=', 1)->get();

        return view('backend.warehouse.inventory_stock', compact('inventory', 'shops'));
    } // End Method

    // Transfer Stock to shop method
    public function TransferStock(Request $request)
    {

        $orgShopId = Auth::user()->shop_id;
        $shopId = $request->shopId;
        $productId = $request->productId;
        $qty = $request->transferStock;
        $datePart = Carbon::now()->format('Ymd'); // e.g., 20240809
        $randomPart = strtoupper(Str::random(6)); // e.g., A1B2C3
        $invoiceNo = 'MGL-' . $datePart . '-' . $randomPart;

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
            'invoice_no' => $invoiceNo,
            'from_shop_id' => $orgShopId,
            'to_shop_id' => $shopId,
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
    $transfers = TransferStock::select(
            'invoice_no',
            'to_shop_id',
            'from_shop_id',
            DB::raw('DATE_FORMAT(MIN(created_at), "%e/%m/%Y") as date')
        )
        ->with('fromShop', 'toShop')
        ->groupBy('invoice_no', 'to_shop_id', 'from_shop_id')
        ->orderBy(DB::raw('MIN(id)'), 'desc') // Using MIN(id) to order by the earliest record in each group
        ->get();

    return view('backend.warehouse.all_transfer_record', compact('transfers'));
}


    // public function AllTransferRecord()
    // {
    //     $transfer = TransferStock::select(
    //         'to_shop_id',
    //         'from_shop_id',
    //         'product_id',
    //         DB::raw('DATE(created_at) as date'),
    //         DB::raw('SUM(quantity) as total_quantity')
    //     )
    //         ->with(['fromshop', 'toshop', 'product'])
    //         ->groupBy('to_shop_id', 'from_shop_id', 'product_id', DB::raw('DATE(created_at)'))
    //         ->orderBy('date', 'desc')
    //         ->get();

    //     return view('backend.warehouse.all_transfer_record', compact('transfer'));
    // } // End Method

    // Detail Transfer Method
    public function DetailTransfer($invoiceNo)
    {
        $transfer = TransferStock::where('invoice_no', $invoiceNo)
            ->select(
                'to_shop_id',
                'from_shop_id',
                'product_id',
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->with(['fromshop', 'toshop', 'product'])
            ->groupBy('to_shop_id', 'from_shop_id', 'product_id', DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc')
            ->get();

        $transferProducts = count($transfer);

        return view('backend.warehouse.detail_transfer', compact('transfer', 'transferProducts'));
    } // End Method


// All Stock IN List Method
public function AllStockIn()
{
    $stockIn = StockIn::select('invoice_no', 'shop_id', DB::raw('DATE_FORMAT(MIN(created_at), "%e/%m/%Y") as date'), DB::raw('MIN(id) as min_id'))
        ->groupBy('invoice_no', 'shop_id')
        ->orderBy('min_id', 'desc') // Order by the minimum id of each group
        ->get();

    return view('backend.warehouse.all_stock_in', compact('stockIn'));
}
// End Method

// Stock Detail Method
    public function DetailStockIn($invoiceNo)
    {
        // Fetch all stock entries with the same invoice number
        $stockInDetails = StockIn::where('invoice_no', $invoiceNo)
            ->with('product', 'shop')
            ->orderBy('id', 'desc')
            ->get();

        $productCount = count($stockInDetails);

        $shopName = $stockInDetails->isNotEmpty() ? $stockInDetails->first()->shop->name : null;

        // Return the view with the stock details and shop name
        return view('backend.warehouse.detail_stock_in', compact('stockInDetails', 'shopName', 'productCount'));
    } // End Method
    // End Method

    // Shop Stockin Method
    public function ShopStockIn()
    {

        $shops = Shop::where('id', '!=', 1)->get();
        $products = Product::latest()->paginate(200); // Change the number '10' to the desired number of products per page
        $categories = Category::latest()->get();

        return view('backend.warehouse.shop_stockin', compact('products', 'categories', 'shops', ));
    } // End Method

    public function StockInOrder(Request $request)
    {

        $cartItem = Cart::content();
        $shopId = $request->shopId;
        $shop = Shop::where('id', $shopId)->first();

        // dd($cartItem->toArray());

        return view('backend.warehouse.shop_stockin_order', compact('shop', 'cartItem'));

    }

    // shop stock Add Method
    public function AddStockInShop(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'shopId' => 'required|integer|exists:shops,id',
        ]);

        if ($validator->fails()) {
            $noti = [
                'message' => 'Invalid request data.',
                'alert-type' => 'error',
            ];
            return redirect()->route('all.stockin')->with($noti);
        }

        $shopId = $request->shopId;
        $cartItems = Cart::content();
        $datePart = Carbon::now()->format('Ymd'); // e.g., 20240809
        $randomPart = strtoupper(Str::random(6)); // e.g., A1B2C3
        $invoiceNo = 'INV-' . $datePart . '-' . $randomPart;

        // Start a database transaction
        DB::beginTransaction();

        try {
            foreach ($cartItems as $item) {
                $productId = $item->id;
                $qty = $item->qty;
                $shopProduct = ShopProduct::where('shop_id', $shopId)
                    ->where('product_id', $productId)
                    ->first();

                if ($shopProduct) {
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

                // Insert the stock record
                StockIn::create([
                    'invoice_no' => $invoiceNo,
                    'shop_id' => $shopId,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'created_at' => Carbon::now(),
                ]);
            }

            // Clear the cart after transferring the stock
            Cart::destroy();

            // Commit the transaction
            DB::commit();

            $noti = [
                'message' => 'Warehouse Product Stock Import Successful',
                'alert-type' => 'success',
            ];
            return redirect()->route('all.stockin')->with($noti);

        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollback();

            // Log the error
            Log::error('Stock import failed', ['error' => $e->getMessage()]);

            $noti = [
                'message' => 'Warehouse Product Stock Import Failed',
                'alert-type' => 'error',
            ];
            return redirect()->route('all.stockin')->with($noti);
        }
    } // End Method

    // Delete Stockin Method
    public function DeleteStockin($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $item = StockIn::findOrFail($id);
                $qty = $item->quantity;
                $productId = $item->product_id;
                $shopId = $item->shop_id;

                if ($shopId == 1) {
                    // Find the corresponding product
                    $product = Product::findOrFail($productId);

                    // Ensure the stock doesn't go negative
                    if ($product->product_store < $qty) {
                        throw new \Exception('Insufficient stock in the main warehouse');
                    }

                    // Reduce stock from main warehouse
                    $product->product_store -= $qty;
                    $product->save();

                } else {
                    // Find the corresponding ShopProduct record
                    $shopProduct = ShopProduct::where('shop_id', $shopId)
                        ->where('product_id', $productId)
                        ->firstOrFail();

                    // Ensure the stock doesn't go negative
                    if ($shopProduct->quantity < $qty) {
                        throw new \Exception('Insufficient stock in the shop');
                    }

                    // Adjust the stock in the shop
                    $shopProduct->quantity -= $qty;
                    $shopProduct->save();
                }

                // Delete the StockIn record
                $item->delete();
            });

            // Return success notification
            $noti = [
                'message' => 'Stock In Deleted Successfully',
                'alert-type' => 'success',
            ];

        } catch (\Exception $e) {
            // Return error notification
            $noti = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('all.stockin')->with($noti);
    }


    // delete transfer record
    public function deleteRecord(Request $request)
    {
        \Log::info('Delete request received', $request->all());

        $fromShopId = $request->fromshopid;
        $toShopId = $request->toshopid;
        $productId = $request->product_id;
        $date = $request->date;

        $startDate = Carbon::parse($date)->startOfDay();
        $endDate = Carbon::parse($date)->endOfDay();

        $deleted = TransferStock::where(function($query) use ($fromShopId, $toShopId) {
                $query->where('from_shop_id', $fromShopId)
                      ->orWhere('to_shop_id', $toShopId);
            })
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
        // Get the shop ID of the authenticated user
        $shopId = Auth::user()->shop_id;

        // Retrieve all shops except the one belonging to the authenticated user
        $shops = Shop::where('id', '!=', $shopId)->get();

        $products = Product::where('expire_date', '>', Carbon::now())
            ->whereColumn('product_store', '>=', 'product_track')
            ->latest()
            ->paginate(200); // Change the number '10' to the desired number of products per page
        // dd($products);

        $categories = Category::latest()->get();

        return view('backend.warehouse.stocks_tranfer', compact('products', 'categories', 'shops', 'shopId'));

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
        $shopId = Auth::user()->shop_id;

        $shops = Shop::latest()->get();

        $products = Product::latest()->paginate(16); // Change the number '10' to the desired number of products per page
        // dd($products);

        $categories = Category::latest()->get();

        return view('backend.warehouse.stock_import', compact('products', 'categories', 'shops', 'shopId'));

    } // End Method

    // Warehouse stock import Method
    public function ImportOrder(Request $request)
    {

        $cartItem = Cart::content();
        $shopId = $request->shopId;
        $shop = Shop::where('id', $shopId)->first();

        // dd($cartItem->toArray());

        return view('backend.warehouse.stock_import_order', compact('shop', 'cartItem'));

    } // End Method

    // Add Stock to Warehouse Method
    public function AddStock(Request $request)
    {

        $shopId = $request->shopId;
        $cartItems = Cart::content();
        $datePart = Carbon::now()->format('Ymd'); // e.g., 20240809
        $randomPart = strtoupper(Str::random(6)); // e.g., A1B2C3
        $invoiceNo = 'INV-' . $datePart . '-' . $randomPart;

        foreach ($cartItems as $item) {
            $productId = $item->id;
            $qty = $item->qty;

            $product = Product::findOrFail($productId);

            // Reduce stock from main warehouse
            $product->product_store += $qty;
            $product->save();

            // Insert the  stockin record
            StockIn::create([
                'invoice_no' => $invoiceNo,
                'shop_id' => $shopId,
                'product_id' => $productId,
                'quantity' => $qty,
                'created_at' => Carbon::now(),
            ]);
        }

        // Clear the cart after transferring the stock
        Cart::destroy();

        $noti = [
            'message' => 'Warehouse Product Stock Import Successful',
            'alert-type' => 'success',
        ];
        return redirect()->route('stock.inventory')->with($noti);
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
        $orgShopId = $request->originalShop;
        $shopId = $request->shopId;
        $cartItems = Cart::content();
        $datePart = Carbon::now()->format('Ymd'); // e.g., 20240809
        $randomPart = strtoupper(Str::random(6)); // e.g., A1B2C3
        $invoiceNo = 'MGL-' . $datePart . '-' . $randomPart;

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
                'invoice_no' => $invoiceNo,
                'from_shop_id' => $orgShopId,
                'to_shop_id' => $shopId,
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

    // Trasnfer Record export daily
    public function StockinDaily()
    {
        return Excel::download(new DailyStockinExport, 'daily_stockin.xlsx');
    }
    // Trasnfer Record export weekly

    public function StockinWeekly()
    {
        return Excel::download(new WeeklyStockinExport, 'weekly_stockin.xlsx');
    }
}
