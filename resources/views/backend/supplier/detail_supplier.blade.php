@extends('admin_dashboard')

@section('admin')
@section('title')
    Detail Supplier | Pencil POS System
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
                    <h4 class="page-title">တင်သွင်းသူ အသေးစိတ်အချက်အလက်</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form >


                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Detail
                                    Supplier
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">တင်အသွင်းသူ အမည်</label>
                                            <p class="text-danger">{{ $supplier->name }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">တင်သွင်းသူ အီးမေးလ်</label>
                                            <p class="text-danger">{{ $supplier->email }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">တင်သွင်းသူ ဖုန်းနံပါတ်</label>
                                            <p class="text-danger">{{ $supplier->phone }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">တင်သွင်းသူ လိပ်စာ</label>
                                            <p class="text-danger">{{ $supplier->address }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">တင်သွင်းသူ ဆိုင်နာမည်</label>
                                            <p class="text-danger">{{ $supplier->shopname }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">တင်သွင်းသူ ပုံစံ</label>
                                            <p class="text-danger">{{ $supplier->type }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">တင်သွင်းသူ ဘဏ်အကောင် နာမည်</label>
                                            <p class="text-danger">{{ $supplier->account_holder }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">တင်သွင်းသူ ဘဏ်အကောင့် နံပါတ်</label>
                                            <p class="text-danger">{{ $supplier->account_number }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Bank Name</label>
                                            <p class="text-danger">{{ $supplier->bank_name }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Bank Branch</label>
                                            <p class="text-danger">{{ $supplier->bank_branch }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">တင်သွင်းသူမြို့နယ်</label>
                                            <p class="text-danger">{{ $supplier->city }}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">တင်သွင်းသူ လိုဂို</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <img id="showImage" src="{{ asset($supplier->image) }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>
                                        </div> <!-- end col -->

                                    </div> <!-- end row -->


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




@endsection
