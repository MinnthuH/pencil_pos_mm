<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    // All Product Page Method
    public function AllProduct()
    {
        $product = Product::latest()->get();
        return view('backend.product.all_product', compact('product'));
    } // End Method

    // Add Product Page Method
    public function AddProduct()
    {
        $product = Product::latest()->get();
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();

        return view('backend.product.add_product', compact('product', 'category', 'supplier'));

    } //End Method

    // Store Product Method
    public function StoreProduct(Request $request)
    {

        $pcode = IdGenerator::generate(['table' => 'products', 'field' => 'product_code', 'length' => 8, 'prefix' => 'PC']);

        $image = $request->file('productImage');
        $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // set photo name (1326491.jpg/png..)
        Image::make($image)->resize(300, 300)->save('upload/product/' . $nameGen);
        $saveUrl = 'upload/product/' . $nameGen;

        Product::insert([
            'product_name' => $request->productName,
            'category_id' => $request->categoryId,
            'supplier_id' => $request->supplierId,
            'product_code' => $pcode,
            'product_garage' => $request->productGarage,
            'product_image' => $saveUrl,
            'product_store' => $request->productStore,
            'product_track' => $request->trackStock,
            'buying_date' => $request->buyingDate,
            'expire_date' => $request->expireDate,
            'buy_price' => $request->buyingPrice,
            'selling_price' => $request->sellingPrice,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'ကုန်ပစ္စည်းအသစ် ထည့်သွင်းခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#product')->with($noti);

    } // End Method

    // Edit Product Method
    public function EditProduct($id)
    {

        $product = Product::findOrFail($id);
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();

        return view('backend.product.edit_product', compact('product', 'category', 'supplier'));

    } // End Method

    // Update Product Method
    public function UpdateProduct(Request $request)
    {

        $productId = $request->id;

        if ($request->file('productImage')) {

            $image = $request->file('productImage');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // set photo name (1326491.jpg/png..)
            Image::make($image)->resize(300, 300)->save('upload/product/' . $nameGen);
            $saveUrl = 'upload/product/' . $nameGen;

            Product::findOrFail($productId)->update([
                'product_name' => $request->productName,
                'category_id' => $request->categoryId,
                'supplier_id' => $request->supplierId,
                'product_code' => $request->productCode,
                'product_garage' => $request->productGarage,
                'product_image' => $saveUrl,
                'product_store' => $request->productStore,
                'product_track' => $request->trackStock,
                'buying_date' => $request->buyingDate,
                'expire_date' => $request->expireDate,
                'buy_price' => $request->buyingPrice,
                'selling_price' => $request->sellingPrice,
                'unit' => $request->unit,
                'created_at' => Carbon::now(),
            ]);
            $noti = [
                'message' => 'ကုန်ပစ္စည်း အပ်ဒိတ်ပြုလုပ်ခြင်း အောင်မြင်ပါသည်',
                'alert-type' => 'success',
            ];
            return redirect()->route('all#product')->with($noti);

        } else {
            Product::findOrFail($productId)->update([
                'product_name' => $request->productName,
                'category_id' => $request->categoryId,
                'supplier_id' => $request->supplierId,
                'product_code' => $request->productCode,
                'product_garage' => $request->productGarage,
                'product_store' => $request->productStore,
                'product_track' => $request->trackStock,
                'buying_date' => $request->buyingDate,
                'expire_date' => $request->expireDate,
                'buy_price' => $request->buyingPrice,
                'selling_price' => $request->sellingPrice,
                'unit' => $request->unit,
                'created_at' => Carbon::now(),
            ]);
            $noti = [
                'message' => 'Product Update Without Image Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all#product')->with($noti);
        } // end end else
    } // End Method

    // Delete Customer Method
    public function DeleteProduct($id)
    {
        $productImg = Product::find($id);
        $Img = $productImg->product_image;
        unlink($Img);

        Product::findOrFail($id)->delete();
        $noti = [
            'message' => 'ကုန်ပစ္စည်းဖျက်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#product')->with($noti);

    } // End Method

    // Code Product Method
    public function CodeProduct($id)
    {

        $product = Product::findOrFail($id);
        $generator = new BarcodeGeneratorPNG();
        $barcodeData = $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128);
        $barcodeImage = base64_encode($barcodeData);
        return view('backend.product.code_product', compact('product', 'barcodeImage'));
    } //End Method

    // Import Product
    public function ImportProduct()
    {

        return view('backend.product.import_product');
    } // End Method

    // Export Product
    public function ExportProduct()
    {
        return Excel::download(new ProductExport, 'producs.xlsx');
    } // End Method

    // Import Product
    public function Import(Request $request)
    {
        Excel::import(new ProductImport, $request->file('importfile'));

        $noti = [
            'message' => 'ကုန်ပစ္စည်းအသစ်များ ဖိုင်ဖြင့်ထည့်သွင်းခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#product')->with($noti);

    } // End Method

    //Refill Stock Method
    public function refillStock(Request $request)
    {

        $id = $request->productId;
        $quantity = $request->refillStock;

        try {
            $product = Product::findOrFail($id);

            // Update the stock quantity
            $product->product_store += $quantity;

            $product->save();

            $noti = [
                'message' => 'ကုန်ပစ္စည်း အရေအတွက် အသစ်ထည့်သွင်းခြင်း အောင်မြင်ပါသည်',
                'alert-type' => 'success',
            ];

            return redirect()->route('manage#stock')->with($noti);
        } catch (\Exception $e) {
            // Handle the exception or display an error message
            $noti = [
                'message' => 'Error: ကုန်ပစ္စည်း အရေအတွက် အသစ်ထည့်သွင်းခြင်း မအောင်မြင်ပါ',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($noti);
        }
    } // End Method

    // Noti Expire Product Method
    public function NotiExpireProduct()
    {

        // Calculate the date 10 days from now
        $expirationDate = Carbon::now()->addDays(10)->toDateString();

        // Retrieve products with expiration date within the next 10 days

        $products = Product::where('expire_date', '<=', $expirationDate)->get();

        // Return the list of products to your view
        return view('backend.stock.noti_expire')->with('products', $products);

    } // End Method


    // Reduce Stock Method
    public function ReduceStock(Request $request)

    {

        $id = $request->productId;
        $quantity = $request->reduceStock;

        try {
            $product = Product::findOrFail($id);

            // Update the stock quantity
            $product->product_store -= $quantity;

            $product->save();

            $noti = [
                'message' => 'သက်တမ်းကုန်ပစ္စည်း အရေအတွက် ပယ်ဖျက်ခြင်း အောင်မြင်ပါသည်',
                'alert-type' => 'success',
            ];

            return redirect()->route('noti.expire')->with($noti);
        } catch (\Exception $e) {
            // Handle the exception or display an error message
            $noti = [
                'message' => 'Error: သက်တမ်းကုန်ပစ္စည်း အရေအတွက် ပယ်ဖျက်ခြင်း အောင်မြင်ပါသည်',
                'alert-type' => 'error',
            ];

            return redirect()->route('noti.expire')->with($noti);
        }
    } // End Method

    // Noti less Stock Method
    public function NotiStock(){
        $lessProducts = Product::where('product_store', '<', DB::raw('product_track'))->get();
        return view('backend.stock.less_stock',compact('lessProducts'));
    } // End method

}
