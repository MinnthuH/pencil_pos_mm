@extends('admin_dashboard')

@section('admin')
@section('title')
    Edit Deli | Pencil POS System
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
                    <h4 class="page-title">Deli ပြင်ဆင်ရန်</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('update.deli') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $deli->id }}">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Deli
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Deli အမည်</label>
                                            <input type="text" name="name" class="form-control" value="{{ $deli->name }}">
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Deli Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $deli->email }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Deli ဖုန်းနံပါတ်</label>
                                            <input type="text" name="phone" class="form-control" value="{{ $deli->phone }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Deli လိပ်စာ</label>
                                            <input type="text" name="address" class="form-control" value="{{ $deli->address }}">
                                        </div>
                                    </div>
                                    <!-- end col -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Update</button>
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
                name: {
                    required : true,
                },
                phone: {
                    required : true,
                },
                email: {
                    required : true,
                },
                address: {
                    required : true,
                },

            },
            messages :{
                name: {
                    required : 'Deliအမည် ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                phone: {
                    required : 'Deli ဖုန်းနံပါတ်ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                email: {
                    required : 'Deli email ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                address: {
                    required : 'Deli လိပ်စာဖြည့်ရန် လိုအပ်ပါသည်',
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
