@extends('admin_dashboard')

@section('admin')
@section('title')
    Edit Employee | Pencil POS System
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
                    <h4 class="page-title">ဖေါက်သည် အချက်အလက် ပြင်ဆင်ခြင်း</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('update#customer') }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{$customer->id}}">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Customer
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ဖေါက်သည် အမည်</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid
                                            @enderror" value="{{$customer->name}}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ဖေါက်သည် အီးမေးလ်</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid
                                            @enderror" value="{{$customer->email}}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ဖေါက်သည် ဖုန်းနံပါတ်</label>
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid
                                            @enderror" value="{{$customer->phone}}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ဖေါက်သည် လိပ်စာ</label>
                                            <input type="text" name="address"
                                                class="form-control @error('address') is-invalid
                                            @enderror" value="{{$customer->address}}">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ဆိုင် အမည်</label>
                                            <input type="text" name="shopname"
                                                class="form-control @error('shopname') is-invalid
                                        @enderror" value="{{$customer->shopname}}">
                                            @error('shopname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ဖေါက်သည် ဘဏ်အကောင့် အမည်</label>
                                            <input type="text" name="accholder"
                                                class="form-control @error('accholder') is-invalid
                                            @enderror" value="{{$customer->account_holder}}">
                                            @error('accholder')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">ဖေါက်သည် ဘဏ်အကောင့် နံပါတ်</label>
                                            <input type="text" name="accnumber"
                                                class="form-control @error('accnumber') is-invalid
                                            @enderror" value="{{$customer->account_number}}">
                                            @error('accnumber')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Bank Name</label>
                                            <input type="text" name="bankname"
                                                class="form-control @error('bankname') is-invalid
                                            @enderror" value="{{$customer->bank_name}}">
                                            @error('bankname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Bank Branch</label>
                                            <input type="text" name="bankbranch"
                                                class="form-control @error('bankbranch') is-invalid
                                            @enderror" value="{{$customer->bank_branch}}">
                                            @error('bankbranch')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">မြို့နယ်</label>
                                            <input type="text" name="city"
                                                class="form-control @error('city') is-invalid
                                            @enderror" value="{{$customer->city}}">
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">ဖေါက်သည် လိုဂို</label>
                                            <input type="file" id="image" name="image" class="form-control @error('image') is-invalid
                                            @enderror">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <img id="showImage" src="{{asset($customer->image)}}"
                                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                        </div>
                                    </div> <!-- end col -->

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




@endsection
