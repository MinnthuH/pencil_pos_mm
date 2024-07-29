@extends('admin_dashboard')

@section('admin')
@section('title')
    Edit Inventory | Pencil POS System
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
                    <h4 class="page-title">စတို ကုန်ပစ္စည်းပြင်ဆင်ရန်</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('update.inventory') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit
                                    Inventory
                                </h5>
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $inventory->id }}">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ကုန်ပစ္စည်း အမည်</label>
                                            <input type="text" class="form-control"
                                                value="{{ $inventory->product->product_name }}" disabled>
                                        </div>
                                    </div>
                                    <!-- end col -->


                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ကုန်ပစ္စည်း အရေအတွက်</label>
                                            <input type="number" name="buy_qty" class="form-control"
                                                value="{{ $inventory->buy_qty }}">
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ဝယ်ယူသည့်နေ့</label>
                                            <input type="date" name="buy_date" class="form-control"
                                                value="{{ $inventory->buy_date }}">
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">ဝယ်ယူသည့် ဈေးနှုန်း</label>
                                            <input type="number" name="buy_price" class="form-control"
                                                value="{{ $inventory->buy_price }}">
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="example-textarea" rows="3">{{ $inventory->description }}</textarea>
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
                buy_qty: {
                    required: true,
                },
                buy_date: {
                    required: true,
                },
                buy_price: {
                    required: true,
                }

            },
            messages: {
                buy_qty: {
                    required: 'ကုန်ပစ္စည်း အေရအတွက် ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                buy_date: {
                    required: 'ဝယ်ယူသည့်ေန့ ဖြည့်ရန် လိုအပ်ပါသည်',
                },
                buy_price: {
                    required: 'ဝယ်ယူသည့်ေဈးနှုန်း ဖြည့်ရန် လိုအပ်ပါသည်',
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
