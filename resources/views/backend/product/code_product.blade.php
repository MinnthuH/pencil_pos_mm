@extends('admin_dashboard')

@section('admin')
@section('title')
    Add Barcode | Pencil POS System
@endsection

{{-- jQuery link --}}
<script src="{{ asset('backend/assets/jquery.js') }}"></script>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('all#product')}}" class="btn btn-blue rounded-pill waves-effect waves-light">
                                <i class="fas fa-arrow-circle-left"></i>
                            </a>
                        </ol>
                    </div>
                    <h4 class="page-title">Barcode Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <h5 class="mb-4 text-uppercase">
                                <i class="fas fa-barcode me-1"></i> Barcode Product
                            </h5>
                            <div class="barcode-container">
                                <div class="barcode-item">
                                    <p>{{ $product->product_name }}</p>
                                    <p>{{ $product->selling_price }} Ks</p>
                                    <img src="data:image/png;base64,{{ $barcodeImage }}" alt="Barcode">
                                    <p>{{ $product->product_code }}</p>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="#" id="printButton" class="btn btn-blue waves-effect waves-light">
                                    <i class="mdi mdi-printer me-1"></i> Print
                                </a>
                            </div>
                        </div> <!-- end settings -->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container -->
</div> <!-- content -->

<style>
    @media print {
        /* Hide everything except .barcode-item */
        body * {
            visibility: hidden;
        }
        .barcode-item, .barcode-item * {
            visibility: visible;
        }
        .barcode-item {
            position: absolute;
            top: 30%;
            left: 50%;

            transform: translate(-50%, -50%); /* Center the item */
            width: calc(40mm - 6px); /* Adjust width to accommodate padding */
            height: calc(30mm - 6px); /* Adjust height to accommodate padding */
            margin: 0;
            padding: 3px; /* Add 3px padding */
            box-sizing: border-box;
            text-align: center; /* Center-align text and barcode */
            font-size: 9px; /* Adjust font size to fit the label */
            display: flex;
            flex-direction: column;
            /* justify-content: space-between; */
        }
        .barcode-item img {
            width: 100%;
            height: 25%;
            margin: 2mm 0; /* Add some space between the barcode and text */
        }
        .barcode-item p {
            margin: 0;
            line-height: 1.5; /* Adjust line height for better spacing */
        }
        /* Ensure the entire page is printed at the correct width */
        @page {
            size: 40mm 30mm; /* Set page size to 40mm by 30mm */
            margin: 0; /* Remove default margins */
        }
        body {
            margin: 0; /* Remove default margins */
        }
    }
</style>


<script>
    document.getElementById('printButton').addEventListener('click', (e) => {
        e.preventDefault();
        window.print();
    });
</script>

@endsection
