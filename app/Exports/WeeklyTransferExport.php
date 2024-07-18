<?php

namespace App\Exports;

use App\Models\TransferStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class WeeklyTransferExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        return TransferStock::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->with('shop', 'product')
            ->get()
            ->map(function($item) {
                return [
                    'Shop Name' => $item->shop->name,
                    'Product Name' => $item->product->product_name,
                    'Transfer Date' => $item->created_at->format('Y-m-d'),
                    'Transfer Quantity' => $item->quantity,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Shop Name',
            'Product Name',
            'Transfer Date',
            'Transfer Quantity',
        ];
    }
}

