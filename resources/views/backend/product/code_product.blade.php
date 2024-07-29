@extends('admin_dashboard')

@section('admin')
@section('title')
    Add Barcode | Pencil POS System
@endsection
{{-- jquery link  --}}
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
                            <a href="{{ route('all#product')}}" class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fas fa-arrow-circle-left"></i></a>
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
                            <h5 class="mb-4 text-uppercase"><i class="fas fa-barcode me-1"></i> Barcode Product</h5>
                            <div class="barcode-container">
                                <div class="barcode-item">
                                    <label class="form-label">{{ $product->product_name }} | {{ $product->selling_price }} Ks</label>
                                    <img id="barcodeImage" src="data:image/png;base64,{{ $barcodeImage }}" alt="Barcode">
                                    <p>{{ $product->product_code }}</p>
                                </div>
                                <div class="barcode-item">
                                    <label class="form-label">{{ $product->product_name }} | {{ $product->selling_price }} Ks</label>
                                    <img id="barcodeImage" src="data:image/png;base64,{{ $barcodeImage }}" alt="Barcode">
                                    <p>{{ $product->product_code }}</p>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="#" id="printButton" class="btn btn-blue waves-effect waves-light"><i class="mdi mdi-printer me-1"></i></a>
                            </div>
                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->
    </div> <!-- container -->
</div> <!-- content -->

<style>
    @media print {
        .barcode-container {
            display: flex;
            flex-wrap: wrap;
            width: 80mm; /* Ensure the container fits the paper width */
        }
        .barcode-item {
            width: 1.5in;
            height: auto;
            margin: 0;
            padding: 0.2in; /* Optional: Add padding between items */
            box-sizing: border-box;
        }
        .barcode-item img {
            width: 100%;
            height: auto;
        }
        /* Ensure the entire page is printed at the correct width */
        @page {
            size: 80mm;
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
