@extends('admin_dashboard')

@section('admin')
@section('title')
    Invoice | Pencil POS System
@endsection
<style>
    @media print {

        /* Set paper size to A4 */
        @page {
            size: A4;
            margin: 0;
            /* Adjust margins as needed */
        }

        /* Adjust content positioning within the A4 page */
        body {
            margin: 20mm;
            /* Set appropriate margins for your content */
            padding: 0;
            /* Reset padding since margins are used */
        }

        /* Set font size and other styles for printing */
        /* Add your custom styles here */
    }
</style>


<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sale Invoice</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sale Invoice</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="logo text-center">
                        <img src="{{ !empty($shop->logo) ? url('upload/shop_logo/' . $shop->logo) : url('upload/no_image.jpg') }}"
                            width="70px" height="70px" alt="">
                    </div>
                    <div id="receipt-header">
                        <h3 id="shop-name" class="text-center">{{ $shop->name }}</h3>
                        <p class="text-center">Address: {{ $shop->address }}</p>
                        <p class="text-center">Tel: {{ $shop->phone }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <p><b>Hello, {{ $customer->name }}</b></p>
                                        <address>
                                            {{ $customer->address }} - {{ $customer->city }}
                                            <br>
                                            <abbr title="Phone">Shop Name:</abbr> {{ $customer->shopname }}<br>
                                            <abbr title="Phone">Phone:</abbr> {{ $customer->phone }}<br>
                                            <abbr title="Phone">Email:</abbr> {{ $customer->email }}
                                        </address>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-md-4 offset-md-2">
                                    <div class="mt-3 float-end">
                                        <p><strong>Order Date : </strong> <span class="float-end">
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                {{ $sale->invoice_date }}</span></p>
                                        <p><strong>Order Status : </strong><span
                                                class="float-end">{{ $sale->payment_type }}</span></p>
                                        <p><strong>Invoice No. : </strong> <span
                                                class="float-end">{{ $sale->invoice_no }}
                                            </span></p>
                                        <p><strong>Cashier. : </strong> <span
                                                class="float-end">{{ Auth::user()->name }}
                                            </span></p>

                                        <p><strong>Deli Services. : </strong> <span
                                                class="float-end">{{ $sale['deli']['name'] ?? '' }}
                                            </span></p>
                                    </div>
                                </div><!-- end col -->

                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-centered">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Item</th>
                                                <th style="width: 10%">Qty</th>
                                                <th style="width: 10%">Unit Cost</th>
                                                <th style="width: 10%" class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sl = 1;
                                            @endphp
                                            @foreach ($contents as $key => $item)
                                                <tr>
                                                    <td>{{ $sl++ }}</td>
                                                    <td>
                                                        <b>{{ $item->name }}</b> <br />

                                                    </td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->price }} Ks</td>
                                                    <td class="text-end">{{ $item->price * $item->qty }} Ks</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix pt-5">
                                    <h6 class="text-muted">မှတ်ချက်: ဝယ်ယူအားပေးမှုကို အထူးကျေးဇူးတင်ပါတယ်။</h6>

                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="float-end">
                                    <p><b>Sub total</b>&nbsp;&nbsp;<span class="float-end"
                                            name="sub_total">{{ $sale->sub_total }}
                                            Ks</span>
                                    </p>
                                    <p><b>Discount</b>&nbsp;&nbsp;<span class="float-end"
                                            name="sub_total">{{ $sale->discount }}
                                            Ks</span>
                                    </p>
                                    <p><b>ပေးငွေ</b> <span class="float-end"
                                            name="sub_total">{{ $sale->accepted_ammount }}
                                            Ks</span>
                                    </p>
                                    <p><b class="text-danger">ကျန်ငွေ</b> <span class="float-end text-danger"
                                            name="sub_total">{{ $sale->due ?? '0' }}
                                            Ks</span>
                                    </p>
                                    <p><b>ပြန်အမ်းငွေ</b> <span class="float-end"
                                            name>{{ $sale->return_change ?? '0' }} Ks</span></p>

                                    <h3 class="float-end">{{ $sale->total }} Ks</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                        <div class="mt-4 mb-1">
                            <div class="text-end d-print-none">

                                <a href="{{ route('stock#product', $sale->id) }}" onclick="window.print()"
                                    class="btn btn-primary waves-effect waves-light" id="printButton">
                                    <i class="mdi mdi-printer me-1"></i> Print
                                </a>


                            </div>
                        </div>

                    </div>
                </div> <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var printButton = document.getElementById('printButton');

        printButton.addEventListener('click', function() {
            // Perform any necessary actions before printing

            window.onafterprint = function() {
                // Define the return route or action after printing is completed
                window.location.href = '/pos';
            };
        });
    });
</script>



@endsection
