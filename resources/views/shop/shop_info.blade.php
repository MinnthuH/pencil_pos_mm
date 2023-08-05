@extends('admin_dashboard')

@section('admin')
@section('title')
    Shop Info | Pencil POS System
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Shop Info</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Shop Info</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ !empty($shopInfo->logo) ? url('upload/shop_logo/' . $shopInfo->logo) : url('upload/no_image.jpg') }}"
                            class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                        <h4 class="mb-0">{{ $shopInfo->name }}</h4>
                        <p class="text-muted">{{ $shopInfo->email }}</p>

                        <button type="button"
                            class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                        <button type="button"
                            class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button>

                        <div class="text-start mt-3">


                            <p class="text-muted mb-2 font-13"><strong>Shop Name :</strong> <span
                                    class="ms-2">{{ $shopInfo->name }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span
                                    class="ms-2">{{ $shopInfo->phone }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span
                                    class="ms-2">{{ $shopInfo->email }}</span></p>
                            <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span
                                    class="ms-2">{{ $shopInfo->address }}</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Descripton :</strong> <span
                                    class="ms-2">{{ $shopInfo->description }}</span></p>


                        </div>

                        <ul class="social-list list-inline mt-3 mb-0">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i
                                        class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                        class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                        class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);"
                                    class="social-list-item border-secondary text-secondary"><i
                                        class="mdi mdi-github"></i></a>
                            </li>
                        </ul>
                    </div>
                </div> <!-- end card -->


            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">


                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('shop#infoUpdate') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $shopInfo->id }}">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Shop
                                    Info</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" name="name" class="form-control" id="firstname"
                                                value="{{ $shopInfo->name }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="lastname"
                                                value="{{ $shopInfo->email }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Phone</label>
                                            <input type="number" name="phone" class="form-control" id="lastname"
                                                value="{{ $shopInfo->phone }}" >
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" id="lastname"
                                                value="{{ $shopInfo->address }}" >
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Description</label>
                                            <textarea class="form-control" name="descripton"  cols="30" rows="10">{{ $shopInfo->description }}</textarea>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Shop Logo</label>
                                            <input type="file" id="image" name="logo"
                                                class="form-control">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <img id="showImage"
                                                src="{{ !empty($shopInfo->logo) ? url('upload/shop_logo/' . $shopInfo->logo) : url('upload/no_image.jpg') }}"
                                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                        </div>
                                    </div> <!-- end col -->

                                </div> <!-- end row -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
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
                address: {
                    required : true,
                },


            },
            messages :{
                name: {
                    required : 'ဆိုင်အမည် ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                phone: {
                    required : 'ဖုန်းနံပါတ််ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                address: {
                    required : 'လိပ်စာဖြည့်ရန် လိုအပ်ပါသည်',
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
