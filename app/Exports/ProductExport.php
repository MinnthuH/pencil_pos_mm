<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::with('category', 'supplier')
            ->select('product_name', 'category_id', 'supplier_id', 'product_code', 'product_garage', 'product_store', 'buying_date', 'expire_date', 'buy_price', 'selling_price')
            ->get()
            ->map(function ($product) {
                return [
                    'Product Name' => $product->product_name,
                    'Category Name' => $product->category->category_name,
                    'Supplier Name' => $product->supplier->name,
                    'Product code' => $product->product_code,
                    'Product garage' => $product->product_garage,
                    'Product Store' => $product->product_store,
                    'Buying Date' => $product->buying_date,
                    'Expire Date' => $product->expire_date,
                    'Buying Price' => $product->buy_price,
                    'Selling Price' => $product->selling_price,
                ];
            });
    }
    public function headings(): array
    {
        return [
            'Product Name',
            'Category Name',
            'Supplier Name',
            'Product code',
            'Product garage',
            'Product Store',
            'Buying Date',
            'Expire Date',
            'Buying Price',
            'Selling Price',
        ];
    }
}
