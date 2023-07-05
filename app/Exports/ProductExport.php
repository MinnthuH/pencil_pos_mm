<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Product::all();
        return Product::select('product_name','category_id','supplier_id','porduct_code','product_garage','product_store','buying_date','expire_date','buy_price','selling_price')->get();
    }
}
