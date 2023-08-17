<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- Bootstrap css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

</head>
<style type="text/css">
    #wrapper {
        width: 280px;
        margin: 0 auto;
        color: #000;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }

    #resturant-name,
    #receipt-footer {
        text-align: center;
    }

    .tb-sale-detail,
    .tb-sale-total {
        width: 100%;
        border-spacing: 0;
        margin-top: 10px;
    }

    .tb-sale-detail {
        text-align: center;
    }

    .tb-sale-detail th {
        border-bottom: 1px solid #000;
    }

    .tb-sale-total td {
        padding: 5px 0;
        padding-left: 1.5%;
        border-bottom: 1px solid #000;
    }

    .tb-sale-total tr:first-child td:nth-child(3) {
        border-left: 1px solid #999;
    }

    .tb-sale-total tr:first-child td:nth-child(4) {
        text-align: right;
        padding-left: 1.5%;
    }

    /* .tb-sale-total tr:not(:first-child) {
        background-color: #ccc;
    } */

    .tb-sale-total tr:not(:first-child) td:nth-child(2) {
        text-align: right;
        padding-right: 1.5%;
    }

    .btn {
        width: 100%;
        cursor: pointer;
        text-align: center;
        border-radius: 5px;
        padding: 10px;
        margin: 5px 0;
        border: none;
    }

    .btn-print {
        background-color: #ffa93c;
    }

    .btn-back {
        background-color: #4fa950;
    }
    @media print {
        .btn {
            display: none;
        }
    }
</style>

<body>

    <div id="wrapper">
        <div id="receipt-header">
            <h3 id="shop-name" class="text-center">{{ $shop->name }}</h3>
            <p class="text-center">Address: {{ $shop->address }}</p>
            <p class="text-center">Tel: {{ $shop->phone }}</p>
            <p>Customer :<strong>{{ $sale['customer']['name'] }}</strong></p>
            <p>Invoice Date :<strong>{{ $sale->invoice_date }}</strong></p>
            <p>Invoice No :<strong>{{ $sale->invoice_no }}</strong></p>
            <p>Payment Type :<strong>{{ $sale->payment_type }}</strong></p>
            <p>Cashier :<strong>{{ Auth::user()->name }}</strong></p>
            <p>Deli Services :<strong>{{ $sale['deli']['name'] ?? '' }}</strong></p>

        </div>
        <div id="receipt-body">
            <table class="tb-sale-detail">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Unit Cost</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 1;
                    @endphp
                    @foreach ($contents as $key => $item)
                         <tr>
                            <td width="30" class="text-start">{{ $sl++ }}</td>
                            <td width="180" class="text-start"> {{ $item->name }}</td>
                            <td width="50">{{ $item->qty }}</td>
                            <td width="55" class="text-end">{{ number_format($item->price) }}
                            </td>
                            <td width="65" class="text-end">
                                {{ number_format($item->price * $item->qty) }}&nbsp;Ks</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="tb-sale-total">
                <tbody>
                    <tr>
                        <td>Total Qty</td>
                        <td>{{ $contents->count() }}</td>
                        <td>ကျသင့်ငွေ</td>
                        <td class="text-end">{{ number_format($sale->sub_total) }}&nbsp;Ks</td>
                    </tr>
                    <tr>
                        <td colspan="2">ပေးငွေ</td>
                        <td colspan="2" class="text-end">{{ number_format($sale->accepted_ammount) }}&nbsp;Ks</td>
                    </tr>
                    <tr>
                        <td colspan="2">ပြန်အမ်းငွေ</td>
                        <td colspan="2">{{ number_format($sale->return_change ?? '0') }}&nbsp;Ks</td>
                    </tr>
                    <tr>
                        <td colspan="2">ကျန်ငွေ</td>
                        <td colspan="2">{{ number_format($sale->due ?? '0') }}&nbsp;Ks</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="receipt-footer">
            <p>{{ $shop->description }}</p>
        </div>
        <div id="buttons">
            <form action="{{ route('pos') }}" method="get">
                <button class="btn btn-back d-print-none" type="submit" id="backButton">
                    Back to Cashier
                </button>
            </form>


            <form action="{{ route('print.invoice') }}" method="get">
                <button class="btn btn-print" type="submit" onclick="window.print(); return false;">
                    Print
                </button>
            </form>




        </div>
    </div>
</body>
<script>
    // Function to handle the print event
    function handlePrint() {
        // Disable the "Back to Cashier" button when printing
        document.getElementById("backButton").disabled = true;

        // Trigger the print dialog
        window.print();

        // Re-enable the "Back to Cashier" button after printing
        document.getElementById("backButton").disabled = false;
    }

    // Attach the handlePrint function to the Print button
    document.getElementById("printButton").addEventListener("click", handlePrint);
</script>


</html>
