<?php

namespace App\Http\Controllers;

use App\Models\Sale;

class RefurnController extends Controller
{
    // Refurn Route
    public function RefurnSale($id)
    {
        $sale = Sale::where('id', $id)->first();
        // dd($sale);
        return view('refurn.refurn_sale');

    }
}