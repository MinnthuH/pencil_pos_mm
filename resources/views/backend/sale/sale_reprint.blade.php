@extends('admin_dashboard')

@section('admin')
@section('title')
    Invoice | Pencil POS System
@endsection

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reprint Sale Invoice</a></li>
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
                    <div class="card-body">
                        <!-- Logo & title -->
                        <div class="clearfix">
                            <div class="float-start">
                                <div class="auth-logo">
                                    <div class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ asset('backend/assets/images/pecnil_textwithlogo.png') }}"
                                                alt="" height="22">
                                        </span>
                                    </div>

                                    <div class="logo logo-light">
                                        <span class="logo-lg">
                                            <img src="{{ asset('backend/assets/images/PencilLogo.png') }}"
                                                alt="" height="22">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h4 class="m-0">Reprint Invoice</h4>
                                <p>Current date and time: {{ \Carbon\Carbon::now() }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <p><b>Hello, {{ $sale['customer']['name']}}</b></p>
                                </div>

                            </div><!-- end col -->
                            <div class="col-md-4 offset-md-2">
                                <div class="mt-3 float-end">
                                    <p><strong>Order Date : </strong> <span class="float-end">
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $sale->invoice_date }}</span></p>
                                    <p><strong>Sale Status : </strong><span
                                            class="float-end">{{ $sale->payment_type }}</span></p>
                                    <p><strong>Invoice No. : </strong> <span class="float-end">{{ $sale->invoice_no}}
                                        </span></p>
                                    <p><strong>Cashier. : </strong> <span class="float-end">{{$sale['user']['name'] }}
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
                                            @foreach ($saleItem as $key => $item)
                                                <tr>
                                                    <td>{{ $key +1 }}</td>
                                                    <td>
                                                        <b>{{ $item['product']['product_name'] }}</b> <br />

                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item['product']['selling_price'] }} Ks</td>
                                                    <td class="text-end">{{ $item['product']['selling_price'] * $item->quantity }} Ks</td>
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
                                    <h6 class="text-muted">မှတ်ချက် </h6><br>
                                    <h6 class="text-muted">ဝယ်ယူအားပေးမှုကို အထူးကျေးဇူးတင်ပါတယ်။ </h6><br>
                                    <h6 class="text-muted">ဝယ်ပြီးပစ္စည်း ပြန်လဲမပေးပါ </h6><br>



                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="float-end">
                                    <p><b>ကျသင့်ငွေ</b> <span class="float-end" name="sub_total">{{ $sale->sub_total }}
                                            Ks</span>
                                    </p>
                                    <p><b>ပေးငွေ</b> <span class="float-end"
                                            name="sub_total">{{ $sale->accepted_ammount }}
                                            Ks</span>
                                    </p>
                                    <p><b>ကျန်ငွေ</b> <span class="float-end" name="sub_total">{{ $sale->due ?? '0' }}
                                            Ks</span>
                                    </p>
                                    <p><b>ပြန်အမ်းငွေ</b> <span class="float-end"
                                            name>{{ $sale->return_change ?? '0' }} Ks</span></p>

                                    <h3>{{ $sale->sub_total }} Ks</h3>
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
