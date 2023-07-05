<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Exports\SalesExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class SaleController extends Controller
{
    // All Sale Method
    public function allSale()
    {
        $sales = Sale::orderBy('id', 'DESC')->get();
        return view('backend.sale.all_sale', compact('sales'));
    } // End Method

    // Detail Sale
    public function detailSale($id)
    {
        $sale = Sale::where('id', $id)->first();
        $saleItem = OrderDetail::with('product')->where('sale_id', $id)->orderBy('id', 'DESC')->get();
        // return view('backend.sale.detail_sale', compact('sale', 'saleItem'));
        return view('backend.sale.sale_reprint', compact('sale', 'saleItem'));
    }// End Method

    public function stockProduct($id){

        $product = OrderDetail::where('sale_id',$id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_store' => DB::raw('product_store-' . $item->quantity)]);
        }
        return redirect()->route('pos');

    } // End Method

    public function exportDailySales()
{
    $currentDate = Carbon::now()->format('Y-m-d');
    $sales = Sale::whereDate('invoice_date', $currentDate)->get();

    return Excel::download(new SalesExport($sales), 'daily_sales.xlsx');
}

public function exportWeeklySales()
{
    $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
    $endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
    $sales = Sale::whereBetween('invoice_date', [$startDate, $endDate])->get();

    return Excel::download(new SalesExport($sales), 'weekly_sales.xlsx');
}

public function exportMonthlySales()
{
    $currentMonth = Carbon::now()->format('m');
    $currentYear = Carbon::now()->format('Y');
    $sales = Sale::whereMonth('invoice_date', $currentMonth)
                   ->whereYear('invoice_date', $currentYear)
                   ->get();

    return Excel::download(new SalesExport($sales), 'monthly_sales.xlsx');
}
}
