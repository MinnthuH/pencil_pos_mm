@extends('admin_dashboard')

@section('admin')
@section('title')
    Refurn | Pencil POS System
@endsection
<script src="{{ asset('backend/assets/jquery.js') }}"></script>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <h4 class="page-title">Invoice No:&nbsp;&nbsp;{{ $sale->invoice_no }}</h4>
                </div>
                <h4 class="page-title">Product Refurn</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="refurnAlert" style="display: none;">
        ရောင်းချထားသည့် ပမာဏထပ် ကျော်လွန်နေပါသည်
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="row">

        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-pane" id="settings">
                        <form id="myForm" method="post" action="{{ route('refurn.store') }}">
                            @csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Refurn Product</h5>
                            <div class="row">
                                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="saleItemId" class="form-label">Product Name</label>
                                        <select name="saleItemId" class="form-select" id="saleItemId" required>
                                            <option selected disabled>Choose a product</option>
                                            @foreach ($saleItem as $item)
                                                <option value="{{ $item->id }}" data-quantity="{{ $item->quantity }}" data-unitcost="{{ $item->unitcost }}">
                                                    {{ $item['product']['product_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="refurnqty" class="form-label">Refurn Qty</label>
                                        <input type="number" name="refurnqty" id="refurnqty" class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="refurn_amout" class="form-label">Refurn Amount</label>
                                        <input type="number" name="refurn_amout" id="refurn_amout" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-danger waves-effect waves-light mt-2">
                                    <i class="mdi mdi-content-save"></i> Refurn
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row-->
</div> <!-- container -->

<script>
    document.getElementById('myForm').addEventListener('submit', function (event) {
        var saleItemSelect = document.getElementById('saleItemId');
        var selectedOption = saleItemSelect.options[saleItemSelect.selectedIndex];
        var saleItemQuantity = selectedOption.getAttribute('data-quantity');
        var refurnQty = document.getElementById('refurnqty').value;

        if (parseInt(refurnQty) > parseInt(saleItemQuantity)) {
            event.preventDefault(); // Prevent form submission
            var alertBox = document.getElementById('refurnAlert');
            alertBox.style.display = 'block';
        }
    });

    // Update refurn_amout based on selected sale item and refurn quantity
    document.getElementById('saleItemId').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var unitCost = selectedOption.getAttribute('data-unitcost');
        var refurnQtyInput = document.getElementById('refurnqty');
        var refurnAmountInput = document.getElementById('refurn_amout');

        refurnQtyInput.addEventListener('input', function () {
            var refurnQty = this.value;
            refurnAmountInput.value = unitCost * refurnQty;
        });
    });

    // Select necessary DOM elements
    const saleItemSelect = document.getElementById('saleItemId');
    const refurnQtyInput = document.getElementById('refurnqty');
    const amountInput = document.getElementById('refurn_amout');

    // Add event listeners for changes in product selection and quantity input
    saleItemSelect.addEventListener('change', updateRefundAmount);
    refurnQtyInput.addEventListener('input', updateRefundAmount);

    function updateRefundAmount() {
        // Get the selected product's unit cost from data attribute
        const selectedOption = saleItemSelect.options[saleItemSelect.selectedIndex];
        const unitCost = parseFloat(selectedOption.getAttribute('data-unitcost'));

        // Get the quantity entered by the user
        const refurnQty = parseFloat(refurnQtyInput.value) || 0;

        // Calculate the refund amount
        const refundAmount = unitCost * refurnQty;

        // Update the amount input field with the calculated amount
        amountInput.value = isNaN(refundAmount) ? '' : refundAmount.toFixed(2);

        // Enable the amount input field (make it readonly) if a valid amount is calculated
        if (!isNaN(refundAmount)) {
            amountInput.removeAttribute('readonly');
        } else {
            amountInput.setAttribute('readonly', 'readonly');
        }

        // Add a submit event listener to the form
        document.getElementById('myForm').addEventListener('submit', function() {
            // Before submitting the form, ensure the amount field is enabled (not disabled)
            amountInput.removeAttribute('disabled');
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                saleItemId: {
                    required: true,
                },
                refurnqty: {
                    required: true,
                }
            },
            messages: {
                saleItemId: {
                    required: 'ကုန်ပစ္စည်းအမည်  ေရွးချယ်ရန် လိုအပ်ပါသည်',
                },
                refurnqty: {
                    required: 'Please select refurn quantity',
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
@endsection
