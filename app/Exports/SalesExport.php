<?php

namespace App\Exports;

use App\Models\Sale;
use App\Models\User;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesExport implements FromCollection, WithHeadings
{ protected $salesData;

    public function __construct($sales)
    {
        $this->salesData = $sales;
    }

    public function collection()
    {
        return collect($this->salesData)->map(function ($sale) {
            $cashierName = $sale->user->name ?? '';
            $customerName = $sale->customer->name ?? '';
            $shop = $sale->shop->name ?? '';

            return [
                $cashierName,
                $customerName,
                $shop,
                $sale->invoice_date,
                $sale->invoice_no,
                $sale->payment_type,
                $sale->sub_total,
                $sale->total,
                $sale->accepted_ammount,
                $sale->return_change,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Cashier Name',
            'Customer Name',
            'Shop Name',
            'Invoice Date',
            'Invoice No',
            'Payment Type',
            'Sub Total',
            'Total',
            'Pay',
            'Return Change',
        ];
    }
}
