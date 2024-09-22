@extends('admin_dashboard')

@section('admin')
@section('title')
    Add Role Permission | Pencil POS System
@endsection
{{-- jquery link  --}}
<script src="{{ asset('backend/assets/jquery.js') }}"></script>
<style type="text/css">
    .form-check-label {
        text-transform: capitalize;
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

                    </div>
                    <h4 class="page-title">Add Role In Permission</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('store#rolepermission') }}" id="myForm">
                                @csrf

                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Role In
                                    Permission
                                </h5>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">All Roles</label>
                                            <select name="roleId" class="form-select" id="example-select">
                                                <option selected disabled>Select Role</option>

                                                @foreach ($roles as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-check mb-2 form-check-primary">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="customckeck14">
                                        <label class="form-check-label" for="customckeck14">Select All</label>
                                    </div>
                                    <hr>
                                    @foreach ($permission_groups as $item)
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-check mb-2 form-check-primary">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="customckeck1">
                                                    <label class="form-check-label"
                                                        for="customckeck1">{{ $item->group_name }}</label>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                @php
                                                    $permission = App\Models\User::getpermissionByGroupName($item->group_name);
                                                @endphp
                                                @foreach ($permission as $item)
                                                    <div class="form-check mb-2 form-check-primary">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $item->id }}" id="customckeck1"
                                                            name="permissions[]">
                                                        <label class="form-check-label"
                                                            for="customckeck{{ $item->id }}">{{ $item->name }}</label>
                                                    </div>
                                                @endforeach
                                                <br>
                                            </div>
                                        </div><!-- end row -->
                                    @endforeach

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
    $('#customckeck14').click(function() {
        if ($(this).is(':checked')) {
            $('input[type = checkbox]').prop('checked', true);
        } else {
            $('input[type = checkbox]').prop('checked', false);
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                roleId: {
                    required : true,
                }

            },
            messages :{
                roleId: {
                    required : 'Please Select Role',
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
