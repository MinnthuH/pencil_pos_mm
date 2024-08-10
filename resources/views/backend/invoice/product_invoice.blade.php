@extends('admin_dashboard')

@section('admin')
@section('title')
    Order | Pencil POS System
@endsection
<script src="{{ asset('backend/assets/jquery.js') }}"></script>

<style>
    .modal-lg {
        max-width: 40%; /* Adjust the width of the modal */
    }
    .modal-body {
        font-size: 20px; /* Increase font size for text in the modal */
    }
    .form-control {
        font-size: 18px; /* Increase font size of input fields */
        height: 50px; /* Increase height of input fields */
        padding: 10px; /* Add padding inside input fields for better appearance */
        font-weight: bold; /* Make font bold in input fields */
    }
    .form-label {
        font-weight: bold; /* Make font bold in labels */
    }
    .form-select {
        font-size: 18px; /* Ensure font size is consistent */
        height: 50px; /* Ensure height is consistent with input fields */
        font-weight: bold; /* Make font bold in select fields */
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Order List</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Order List</h4>
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
                            <div class="float-end">
                                <h4 class="m-0 d-print-none">Order</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <p><b>Hello, {{ $customer->name }}</b></p>
                                </div>

                            </div><!-- end col -->
                            <div class="col-md-4 offset-md-2">
                                <div class="mt-3 float-end">
                                    <p><strong>Order Date : </strong> <span class="float-end">
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ \Carbon\Carbon::now()->setTimezone('Asia/Yangon')->format('Y-m-d H:i:s') }}
                                        </span></p>
                                        <p><strong>Deli Services : </strong> <span class="float-end">
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            {{ $deli->name ?? 'null' }}
                                        </span></p>

                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <h6>Billing Address</h6>
                                <address>
                                    {{ $customer->address }} - {{ $customer->city }}
                                    <br>
                                    <abbr title="Phone">Shop Name:</abbr> {{ $customer->shopname }}<br>
                                    <abbr title="Phone">Phone:</abbr> {{ $customer->phone }}<br>
                                    <abbr title="Phone">Email:</abbr> {{ $customer->email }}
                                </address>
                            </div> <!-- end col -->

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
                                            @foreach ($cartItem as $key => $item)
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
                                    <p><b>ကျသင့်ငွေ</b>&nbsp;&nbsp;<span class="float-end" name="sub_total">{{ Cart::subtotal() }}
                                            Ks</span>
                                    </p>
                                    <h3 class="text-end">{{ Cart::total() }} Ks</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4 mb-1">
                            <div class="text-end d-print-none">
                                <button type="button" class="btn btn-blue" data-bs-toggle="modal"
                                    data-bs-target="#signup-modal">ငွေချေရန်</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->
<!-- Signup modal content -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Increase modal size -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice Of {{ $customer->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="px-3" action="{{ url('final-invoice') }}" method="post" id="myForm">
                    @csrf
                    <div class="mb-3">
                        <label for="totalAmount" class="form-label">Total Amount</label>
                        <input class="form-control" type="number" id="totalAmount" name="totalAmount" value="{{ Cart::total() }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input class="form-control" type="number" id="discount" name="discount" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="paymetnStatus" class="form-label">Payment</label>
                        <select name="paymetnStatus" class="form-select mt-3" id="example-select">
                            <option selected disabled>ငွေပေးချေခြင်းပုံစံ ရွေးချယ်ရန်</option>
                            <option value="လက်ငင်း">လက်ငင်း</option>
                            <option value="Moblie Payment">Mobile Payment</option>
                            <option value="အကြွေး" id="installmentOption">အကြွေး</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payNow" class="form-label">ပေးငွေ</label>
                        <input class="form-control" type="number" id="payNow" name="payNow" placeholder="လက်ခံရရှိငွေ">
                    </div>
                    <div class="mb-3">
                        <label for="returnChange" class="form-label">ပြန်အမ်းငွေ</label>
                        <input class="form-control" type="number" id="returnChange" name="returnChange">
                    </div>
                    <div class="mb-3">
                        <label for="due" class="form-label">ကျန်ငွေ</label>
                        <input class="form-control" type="number" id="due" name="due">
                    </div>
                    <input type="hidden" name="customerId" value="{{ $customer->id }}">
                    <input type="hidden" name="deliId" value="{{ $deli->id ?? '' }}">
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="orderDate" value="{{ date('d-F-Y') }}">
                    <input type="hidden" name="orderStaus" value="pending">
                    <input type="hidden" name="porductCount" value="{{ Cart::count() }}">
                    <input type="hidden" name="subTotal" value="{{ Cart::subtotal() }}">
                    <input type="hidden" name="total" value="{{ Cart::total() }}">
                    <input type="hidden" name="capital" value="{{ $totalBuyPrice }}">
                    <div class="mb-3 text-center">
                        <button class="btn btn-blue" type="submit">ပေးချေမည်</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- JavaScript to focus on payNow input field -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalElement = document.getElementById('signup-modal');
        modalElement.addEventListener('shown.bs.modal', function () {
            var payNowInput = document.getElementById('payNow');
            payNowInput.focus();
        });
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var payNowInput = document.getElementById('payNow');
        var returnChangeInput = document.getElementById('returnChange');
        var dueInput = document.getElementById('due');
        var discountInput = document.getElementById('discount');
        var totalAmountInput = document.getElementById('totalAmount');
        var totalHiddenInput = document.getElementsByName('total')[0]; // Get the hidden input element
        var installmentOption = document.getElementById('installmentOption');

        function updateInstallmentOption() {
            if (dueInput.value !== '') {
                installmentOption.selected = true;
            } else {
                installmentOption.selected = false;
            }
        }

        function updateReturnAndDue() {
            var total = parseFloat(totalAmountInput.value);
            var payAmount = parseFloat(payNowInput.value);
            var returnChange = payAmount - total;

            if (!isNaN(returnChange) && returnChange >= 0) {
                returnChangeInput.value = returnChange.toFixed(0);
                dueInput.value = '';
            } else {
                returnChangeInput.value = '';
                dueInput.value = Math.abs(returnChange).toFixed(0);
            }

            updateInstallmentOption();
        }

        discountInput.addEventListener('input', function() {
            var initialTotal = parseFloat('{{ Cart::total() }}');
            var discount = parseFloat(discountInput.value) || 0;
            var newTotal = initialTotal - discount;

            if (!isNaN(newTotal) && newTotal >= 0) {
                totalAmountInput.value = newTotal.toFixed(0);
                totalHiddenInput.value = newTotal.toFixed(0); // Update hidden input value
            } else {
                totalAmountInput.value = initialTotal.toFixed(0);
                totalHiddenInput.value = initialTotal.toFixed(0); // Update hidden input value
            }

            updateReturnAndDue();
        });

        payNowInput.addEventListener('input', function() {
            updateReturnAndDue();
        });

        dueInput.addEventListener('input', function() {
            updateInstallmentOption();
        });

        updateInstallmentOption();
        updateReturnAndDue();
    });
</script>

{{-- prevent minus value  --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var discountInput = document.getElementById('discount');
        var payNowInput = document.getElementById('payNow');
        var returnChangeInput = document.getElementById('returnChange');
        var dueInput = document.getElementById('due');

        function convertToPositive(inputElement) {
            inputElement.addEventListener('input', function() {
                var value = parseFloat(inputElement.value);
                if (isNaN(value)) {
                    inputElement.value = '';
                } else if (value < 0) {
                    inputElement.value = Math.abs(value);
                }
            });
        }

        convertToPositive(discountInput);
        convertToPositive(payNowInput);
        convertToPositive(returnChangeInput);
        convertToPositive(dueInput);
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                payNow: {
                    required: true,
                },
                paymetnStatus: {
                    required: true,
                },
            },
            messages: {
                payNow: {
                    required: 'ပေးငွေဖြည့်ပါ',
                },
                paymetnStatus: {
                    required: 'ငွေပေးချေမှု ပုံစံရွေးချယ်ပါ',
                },

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalElement = document.getElementById('signup-modal');
        modalElement.addEventListener('shown.bs.modal', function () {
            var payNowInput = document.getElementById('payNow');
            payNowInput.focus();
        });
    });
</script>


@endsection
