<?php

namespace App\Exports;

use App\Models\Sale;
use App\Models\User;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesExport implements FromCollection, WithHeadings
{protected $sales;

    public function __construct($sales)
    {
        $this->sales = $sales;
    }

    public function collection()
    {
        return Sale::select('user_id','customer_id','invoice_date','invoice_no','payment_type','sub_total','accepted_ammount','due','return_change')->get();
    }

    public function headings(): array
    {
        return [
            'Cashier Name',
            'Customer Name',
            'Invoice Date',
            'Invoice No',
            'Payment Type',
            'Total',
            'Pay',
            'Due',
            'Return Change',
        ];
    }
    public function map($sale): array
{
    $cashierName = $sale->user->name ?? '';
    $customerName = $sale->customer->name ?? '';

    return [
        $cashierName,
        $customerName,
        $sale->invoice_date,
        $sale->invoice_no,
        $sale->payment_type,
        $sale->sub_total,
        $sale->accepted_ammount,
        $sale->due,
        $sale->return_change,
    ];
}

    // public function query()
    // {
    //     return Sale::query();
    // }
}
