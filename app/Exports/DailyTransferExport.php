<?php
namespace App\Exports;

use App\Models\TransferStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class DailyTransferExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TransferStock::whereDate('created_at', Carbon::today())
            ->with('fromshop', 'toshop', 'product')
            ->get()
            ->map(function($item) {
                return [
                    'From Shop Name' => $item->fromshop->name ?? 'N/A',
                    'To Shop Name' => $item->toshop->name ?? 'N/A',
                    'Product Name' => $item->product->product_name ?? 'N/A',
                    'Transfer Date' => $item->created_at->format('Y-m-d'),
                    'Transfer Quantity' => $item->quantity,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'From Shop Name',
            'To Shop Name',
            'Product Name',
            'Transfer Date',
            'Transfer Quantity',
        ];
    }
}
