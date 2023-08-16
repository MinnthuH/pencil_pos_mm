<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Exports\SalesExport;
use Illuminate\Http\Request;
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

    // Delete Sale Method
    public function DeleteSale($id){
        Sale::findOrFail($id)->delete();
        $noti = [
            'message' => 'အရောင်းစာရင်း ပယ်ဖျက်ခြင်း အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#sale')->with($noti);
      }// End Method

    // Trash Sale Method
    public function TrashSale(){
        $sales = Sale::onlyTrashed()->get();
        return view('backend.sale.trash_sale',compact('sales'));

    }// End Method

    // Force Delete Sale Method
    public function ForceDeleteSale($id){
        $sale = Sale::withTrashed()->findOrFail($id);
        if(!empty($sale)){
            $sale->forceDelete();
        }
        $noti = [
            'message' => 'အရောင်းစာရင်း အပြီးပယ်ဖျက်ပြီးပါပြီ',
            'alert-type' => 'success',
        ];
        return redirect()->back();

    } // End Method

    // Detail Sale
    public function detailSale($id)
    {
        $shop = Shop::first();
        $sale = Sale::where('id', $id)->first();
        $saleItem = OrderDetail::with('product')->where('sale_id', $id)->orderBy('id', 'DESC')->get();
        // return view('backend.sale.sale_reprint', compact('sale', 'saleItem'));
        return view('backend.sale.sale_reprint_80mm', compact('sale', 'saleItem','shop'));

    } // End Method


    public function stockProduct($id)
    {

        $product = OrderDetail::where('sale_id', $id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_store' => DB::raw('product_store-' . $item->quantity)]);
        }
        return redirect()->route('pos');

    } // End Method

    public function exportDailySales()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $sales = Sale::with('user', 'customer') // Eager load the user and customer relationships.
            ->whereDate('invoice_date', $currentDate)
            ->get();

        return Excel::download(new SalesExport($sales), 'daily_sales.xlsx');
    }

    public function exportWeeklySales()
{
    $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
    $endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
    $sales = Sale::with('user', 'customer') // Eager load the user and customer relationships.
        ->whereBetween('invoice_date', [$startDate, $endDate])
        ->get();

    return Excel::download(new SalesExport($sales), 'weekly_sales.xlsx');
}

public function exportMonthlySales()
{
    $currentMonth = Carbon::now()->format('m');
    $currentYear = Carbon::now()->format('Y');
    $sales = Sale::with('user', 'customer') // Eager load the user and customer relationships.
        ->whereMonth('invoice_date', $currentMonth)
        ->whereYear('invoice_date', $currentYear)
        ->get();

    return Excel::download(new SalesExport($sales), 'monthly_sales.xlsx');
}
    // pending due method
    public function PendingDue(){

        $alldue = Sale::where('due','>','0')->orderBy('id','DESC')->get();
        return view('backend.sale.pending_due',compact('alldue'));
}// End Method

// sale due method
    public function SaleDueAjax($id){
        $sale = Sale::findOrFail($id);
        return response()->json($sale);
    } // End Method


    // Update Sale Due Method
    public function UpdateSaleDue(Request $request){

        $saleId = $request->id;
        // $payAmount = $request->pay;
        $dueAmmount = $request->due;

        $allSale = Sale::findOrFail($saleId);
        $mainDue = $allSale->due;
        $mainPay = $allSale->accepted_ammount;

        $paidDue = $mainDue - $dueAmmount;
        $paidPay = $mainPay + $dueAmmount;

        Sale::findOrFail($saleId)->update([
            'accepted_ammount' =>$paidPay,
            'due' =>$paidDue,
        ]);

        $noti = [
            'message' => 'ကြွေးကျန်ပေးချေမှု အောင်မြင်ပါသည်',
            'alert-type' => 'success',
        ];

        return redirect()->route('pending.due')->with($noti);

    } // End Method

}
