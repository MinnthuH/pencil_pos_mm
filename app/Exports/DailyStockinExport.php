<?php

namespace App\Exports;

use App\Models\StockIn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class DailyStockinExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return StockIn::whereDate('created_at', Carbon::today())
            ->with('shop', 'product')
            ->get()
            ->map(function($item) {
                return [
                    'Invoice No' => $item->invoice_no,
                    'Shop Name' => $item->shop->name ?? 'N/A',
                    'Product Name' => $item->product->product_name ?? 'N/A',
                    'Quantity' => $item->quantity,
                    'Date' => $item->created_at->format('Y-m-d'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Invoice No',
            'Shop Name',
            'Product Name',
            'Quantity',
            'Date',
        ];
    }
}

