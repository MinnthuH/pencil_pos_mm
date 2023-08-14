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

            return [
                $cashierName,
                $customerName,
                $sale->invoice_date,
                $sale->invoice_no,
                $sale->payment_type,
                $sale->sub_total,
                $sale->discount,
                $sale->total,
                $sale->accepted_ammount,
                $sale->due,
                $sale->return_change,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Cashier Name',
            'Customer Name',
            'Invoice Date',
            'Invoice No',
            'Payment Type',
            'Sub Total',
            'Discount',
            'Total',
            'Pay',
            'Due',
            'Return Change',
        ];
    }
}
