<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class WarehouseStockExport implements FromCollection, WithHeadings, WithTitle, WithCustomStartCell, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::with('category')
            ->select('product_name', 'category_id', 'product_code', 'product_store', 'expire_date', 'selling_price')
            ->get()
            ->map(function ($product) {
                return [
                    'Product Name' => $product->product_name,
                    'Category Name' => $product->category->category_name,
                    'Product code' => $product->product_code,
                    'Product Store' => $product->product_store,
                    'Expire Date' => $product->expire_date,
                    'Selling Price' => $product->selling_price,
                ];
            });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Product Name',
            'Category Name',
            'Product code',
            'Product Store',
            'Expire Date',
            'Selling Price',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Warehouse Stock - ' . Carbon::now()->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A2';
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }
}
