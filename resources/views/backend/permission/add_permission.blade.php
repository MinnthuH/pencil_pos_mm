@extends('admin_dashboard')

@section('admin')
@section('title')
    Add Permission | Pencil POS System
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

                    </div>
                    <h4 class="page-title">Add Permission</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('store#permission') }}" id="myForm">
                                @csrf

                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Permission
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="permission name" class="form-label">Permission Name</label>
                                            <input type="text" name="permissionName"
                                                class="form-control">

                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Group Name</label>
                                            <select name="gorupName" class="form-select" id="example-select">
                                                <option selected disabled>Select Gorup</option>
                                                <option value="pos">Pos</option>
                                                <option value="employee">Employee</option>
                                                <option value="customer">Customer</option>
                                                <option value="supplier">Supplier</option>
                                                <option value="salary">Salary</option>
                                                <option value="attendence">Attendence</option>
                                                <option value="category">Category</option>
                                                <option value="product">Product</option>
                                                <option value="expense">Expense</option>
                                                <option value="product">Product</option>
                                                <option value="stock">Stock</option>
                                                <option value="admin">Admin</option>
                                                <option value="roles">Roles & Permission</option>
                                                <option value="order">Order</option>

                                            </select>
                                        </div>
                                    </div>
                                    <!-- end col -->



                                </div> <!-- end row -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Save</button>
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
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                permissionName: {
                    required : true,
                },
                gorupName: {
                    required : true,
                },

            },
            messages :{
                permissionName: {
                    required : 'Please Enter Permission Name',
                },
                gorupName: {
                    required : 'Please Select Group',
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
