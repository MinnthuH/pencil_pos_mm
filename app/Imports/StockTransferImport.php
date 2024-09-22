<?php

namespace App\Imports;

use App\Models\TransferStock;
use App\Models\Product;
use App\Models\ShopProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class StockTransferImport implements ToModel, WithHeadingRow
{
    protected $shopId;

    public function __construct($shopId)
    {
        $this->shopId = $shopId;
    }

    public function model(array $row)
    {
        // Use the provided shopId from the form
        $shopId = $this->shopId;

        // Find the product based on the provided data
        $product = Product::where('product_name', $row['product_name'])
            ->where('category_name', $row['category_name'])
            ->where('product_code', $row['product_code'])
            ->first();

        if ($product) {
            $productId = $product->id;
            $qty = $row['product_store'];

            // Find the ShopProduct record
            $shopProduct = ShopProduct::where('shop_id', $shopId)
                ->where('product_id', $productId)
                ->first();

            if ($shopProduct) {
                // Reduce stock from main warehouse
                if ($product->product_store < $qty) {
                    return null; // Skip this row if there's not enough stock
                }

                $product->product_store -= $qty;
                $product->save();

                // Update or create ShopProduct record
                $shopProduct->quantity += $qty;
                $shopProduct->save();

                // Insert the transfer stock record
                return new TransferStock([
                    'shop_id' => $shopId,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return null;
    }
}
