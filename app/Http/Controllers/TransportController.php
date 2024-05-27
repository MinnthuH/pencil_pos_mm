<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Models\TransportCharge;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransportController extends Controller
{

    // All Transport Method
    public function AllTransport()
    {
        $transports = Transport::latest()->get();
        return view('backend.transport.all_transport', compact('transports'));
    }
    // Add Transport Method
    public function AddTransport()
    {
        return view('backend.transport.add_transport');
    } // End method

    // Store Transport Method
    public function StoreTransport(Request $request)
    {

        Transport::insert([
            'transport_type' => $request->transport_type,
            'transport_chagre' => $request->transport_chagre,
            'created_at' => Carbon::now(),
        ]);

        $noti = [
            'message' => 'Transport Add Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.transport')->with($noti);
    } // End method

    // Edit Transport Method
    public function EditTransport($id)
    {
        $transport = Transport::findOrFail($id);
        return view('backend.transport.edit_transport', compact('transport'));
    } // End Method

    // Update Transport Method
    public function UpdateTransport(Request $request)
    {
        // dd($request->all());
        Transport::findOrFail($request->id)->update([
            'transport_type' => $request->transport_type,
            'transport_chagre' => $request->transport_chagre,
            'updated_at' => Carbon::now(),
        ]);

        $noti = [
            'message' => 'Transport Update Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.transport')->with($noti);
    } // End Method

    // Delete Transport Method
    public function DeleteTransport($id)
    {
        Transport::findOrFail($id)->delete();

        $noti = [
            'message' => 'Transport Delete Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.transport')->with($noti);
    }

    // Transport Details Method
    public function Transport()
    {
        $transports = TransportCharge::latest()->get();
        return view('backend.transport.transport', compact('transports'));
    }

    // Delete Detail Transport
    public function DeleteDetailTransport($id)
    {

        TransportCharge::findOrFail($id)->delete();

        $noti = [
            'message' => 'Transport Delete Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('detail.transport')->with($noti);
    }
}
