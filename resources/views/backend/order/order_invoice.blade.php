<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: rgb(12, 3, 95);
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: rgb(12, 3, 95);
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                <h2 style="color: rgb(12, 3, 95); font-size: 26px;"><strong>Pencil POS</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
               Pencilitsolutions
               Email:support@pencilitsolutions.com <br>
               Mob: 09795516433 <br>
               No(1/70), DaMaPyiYa Street, TawTike,Mingalardon, Wireless <br>

            </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Customer Name:</strong> {{ $order->customer->name }} <br>
                    <strong>Customer Email:</strong> {{ $order->customer->email }} <br>
                    <strong>Customer Phone:</strong> {{ $order->customer->phone }} <br>

                    <strong>Address: {{ $order->customer->address }}</strong>
                    <strong>Shop Name: {{ $order->customer->shopname }}</strong>

                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: rgb(12, 3, 95);">Invoice:</span> {{ $order->invoice_no}} </h3>
                Order Date: {{ $order->order_date }} <br>
                Order Status: {{ $order->order_status }} <br>
                Payment Status: {{ $order->paymet_status }} <br>
                Total Pay : {{ $order->pay }} <br>
                Total Due : {{ $order->due }} </span>

                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Products</h3>


    <table width="100%">
        <thead style="background-color: rgb(12, 3, 95); color:#FFFFFF;">
            <tr class="font">
                <th>Sl </th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($orderItem as $key => $item)
                <tr class="font">
                    <td align="center">
                        {{$key+1}}
                    </td>
                    <td align="center">{{ $item->product->product_name}} </td>

                    <td align="center">{{ $item->product->porduct_code}} </td>
                    <td align="center">{{ $item->quantity}} </td>



                    <td align="center">{{ $item->product->selling_price}} Ks </td>
                    <td align="center">{{ $item->total}} Ks </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: rgb(12, 3, 95);">Subtotal:</span>{{ $item->total}} Ks </h2>
                <h2><span style="color: rgb(12, 3, 95);">Total:</span> {{ $item->total}} Ks </h2>
                {{-- <h2><span style="color: rgb(12, 3, 95);">Full Payment PAID</h2> --}}
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>Thanks For Buying Products..!!</p>
    </div>
    <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Authority Signature:</h5>
    </div>
</body>

</html>
