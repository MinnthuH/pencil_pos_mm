@extends('admin_dashboard')

@section('admin')
@section('title')
    Edit Admin | Pencil POS System
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
                    <h4 class="page-title">Edit Admin</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('update#admin') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="id" name="id" value="{{$adminUser->id}}">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Admin
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $adminUser->name }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control"  value="{{ $adminUser->email }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control"  value="{{ $adminUser->phone }}">
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Asign Role</label>
                                            <select name="roleId" class="form-select" id="example-select">
                                                <option selected disabled>Select Role</option>
                                                @foreach ($roles as $item)
                                                    <option value="{{ $item->id }}" {{$adminUser->hasRole($item->name)? 'selected':''}}>{{ $item->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                    <!-- end col -->

                                </div> <!-- end row -->

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
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                phone: {
                    required: true,
                },

                password: {
                    required: true,
                },

                roleId: {
                    required: true,
                }

            },
            messages: {
                name: {
                    required: 'Please Enter Name',
                },
                email: {
                    required: 'Please Enter Email',
                },
                phone: {
                    required: 'Please Enter Phone',
                },
                password: {
                    required: 'Please Enter Passwrod',
                },

                roleId: {
                    required: 'Please Select Role',
                }



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
