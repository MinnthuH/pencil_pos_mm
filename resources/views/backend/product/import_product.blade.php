@extends('admin_dashboard')

@section('admin')
@section('title')
    Import Porduct | Pencil POS System
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
                            <a href="{{ route('export#product')}}" class="btn btn-success rounded-pill waves-effect waves-light">Download Xlsx</a>
                        </ol>
                    </div>
                    <h4 class="page-title">Import Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('import') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Xlsx file Import</label>
                                            <input type="file" name="importfile" class="form-control">
                                        </div>
                                    </div>
                                    <!-- end col -->

                                </div> <!-- end row -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Upload</button>
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

</div> <!-- content -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                productName: {
                    required : true,
                },
                categoryId: {
                    required : true,
                },
                supplierId: {
                    required : true,
                },

                productGarage: {
                    required : true,
                },
                productStore: {
                    required : true,
                },
                buyingDate: {
                    required : true,
                },
                expireDate: {
                    required : true,
                },
                buyingPrice: {
                    required : true,
                },
                sellingPrice: {
                    required : true,
                },
                productImage: {
                    required : true,
                },
            },
            messages :{
                productName: {
                    required : 'Please Enter Product Name',
                },
                categoryId: {
                    required : 'Please Select Category',
                },
                supplierId: {
                    required : 'Please Select Supplier',
                },
                productGarage: {
                    required : 'Please Enter Product Garage',
                },
                productStore: {
                    required : 'Please Enter Product Store',
                },
                buyingDate: {
                    required : 'Please Enter Buying Date',
                },
                expireDate: {
                    required : 'Please Enter Expire Date',
                },
                buyingPrice: {
                    required : 'Please Enter Buying Price',
                },
                sellingPrice: {
                    required : 'Please Enter Selling Price',
                },
                productImage: {
                    required : 'Please Enter Product Image',
                },

            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>




@endsection
