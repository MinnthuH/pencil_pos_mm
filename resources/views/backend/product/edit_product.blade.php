@extends('admin_dashboard')

@section('admin')
@section('title')
    Edit Porduct | Pencil POS System
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
                    <h4 class="page-title">ကုန်ပစ္စည်းအချက်အလက် ပြင်ဆင်ခြင်း</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('update#porduct') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{$product->id}}">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Product
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ကုန်ပစ္စည်း အမည်</label>
                                            <input type="text" name="productName" class="form-control"
                                                value="{{ $product->product_name }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">အမျိုးအစား</label>
                                            <select name="categoryId" class="form-select" id="example-select">
                                                <option selected disabled>အမျိုးအစား အရွေးချယ်ပါ</option>
                                                @foreach ($category as $item)
                                                    <option
                                                        value="{{ $item->id }}"{{ $item->id == $product->category_id ? 'selected' : '' }}>
                                                        {{ $item->category_name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">တင်သွင်းသူ</label>
                                            <select name="supplierId" class="form-select" id="example-select">
                                                <option selected disabled>တင်သွင်းသူ ရွေးချယ်ပါ</option>
                                                @foreach ($supplier as $sup)
                                                    <option value="{{ $sup->id }}"{{ $sup->id == $product->supplier_id ? 'selected' : '' }}>{{ $sup->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Product Code</label>
                                            <input type="text" name="productCode" class="form-control"
                                                value="{{ $product->product_code }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ကုန်ပစ္စည်းထားသည့်နေရာ</label>
                                            <input type="text" name="productGarage" class="form-control"
                                                value="{{ $product->product_garage }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ကုန်ပစ္စည်း အရေအတွက်</label>
                                            <input type="text" name="productStore" class="form-control"
                                                value="{{ $product->product_store }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ဝယ်ယူသည့်နေ့</label>
                                            <input type="date" name="buyingDate" class="form-control"
                                                value="{{ $product->buying_date }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">သက်တမ်းကုန်သည့်နေ့</label>
                                            <input type="date" name="expireDate" class="form-control"
                                                value="{{ $product->expire_date }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ဝယ်ယူသည့် ဈေးနှုန်း</label>
                                            <input type="text" name="buyingPrice"
                                                class="form-control"value="{{ $product->buy_price }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ရောင်းဈေး</label>
                                            <input type="text" name="sellingPrice" class="form-control"
                                                value="{{ $product->selling_price }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ရေတွက်ပုံ</label>
                                            <input type="text" name="unit" class="form-control"
                                                value="{{ $product->unit }}">
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="lastname" class="form-label">ကုန်ပစ္စည်းဓါတ်ပုံ</label>
                                            <input type="file" id="image" name="productImage"
                                                class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <img id="showImage" src="{{ asset($product->product_image) }}"
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

<script type="text/javascript">
    $(document).ready(function() {
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
                unit: {
                    required : true,
                },
            },
            messages :{
                productName: {
                    required : 'ကုန်ပစ္စည်းအမည် ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                categoryId: {
                    required : 'ကုန်ပစ္စည်းအမျိုးအစား ရွေးချယ်ရန် လိုအပ်ပါသည်',
                },
                supplierId: {
                    required : 'ကုန်ပစ္စည်းတင်သွင်းသူ ရွေးချယ်ရန် လိုအပ်ပါသည်',
                },
                productGarage: {
                    required : 'ကုန်ပစ္စည်းထားသည့်နေရာ ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                productStore: {
                    required : 'ကုန်ပစ္စည်းအရေအတွက် ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                buyingDate: {
                    required : 'ကုန်ပစ္စည်းဝယ်သည့်နေ့ ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                expireDate: {
                    required : 'ကုန်ပစ္စည်းသက်တမ်းကုန်ဆုံးရက် ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                buyingPrice: {
                    required : 'ကုန်ပစ္စည်းဝယ်ဈေး ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                sellingPrice: {
                    required : 'ကုန်ပစ္စည်းရောင်းဈေး ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                productImage: {
                    required : 'ကုန်ပစ္စည်းဓါတ်ပုံ ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                unit: {
                    required: 'ကုန်ပစ္စည်းရေတွက်ပုံ ဖြည့်ရန် လိုအပ်ပါသည်',
                },


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
