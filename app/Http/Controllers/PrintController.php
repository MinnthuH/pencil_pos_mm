<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

class PrintController extends Controller
{
    public function printInvoice()
{
    // Fetch the sale data and related information here

    // Create a connector for the Bluetooth printer
    $printerMacAddress = '00:11:22:33:44:55'; // Replace with your printer's MAC address
    $connector = new NetworkPrintConnector("tcp://{$printerMacAddress}");

    // Create a printer instance
    $printer = new Printer($connector);

    // Generate ESC/POS commands for the content and print
    $printer->text("Your ESC/POS commands here\n");
    // ... Add more ESC/POS commands ...

    // Close the printer connection
    $printer->close();

    // Redirect back after printing
    return redirect()->route('pos');
}
}
