@extends('admin_dashboard')

@section('admin')
@section('title')
    POS | Pencil POS System
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ကောင်တာ</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">POS</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-4 col-xl-4">
                <div class="card text-center">
                    <div class="card-body">

                        <table class="table table-bordered border-primary mb-0">
                            <thead>

                                <tr>
                                    <th>Name</th>
                                    <th>QTY</th>
                                    <th>Price</th>
                                    <th>SubTotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                                $allcart = Cart::content();
                            @endphp
                            <tbody>
                                @foreach ($allcart as $cart)
                                    <tr>

                                        <td>{{ $cart->name }}</td>
                                        <td>
                                            <form action="{{ url('/cart_update/' . $cart->rowId) }}" method="post">
                                                @csrf
                                                <input type="number" name="qty" style="width:40px;" min="1"
                                                    value="{{ $cart->qty }}">
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    style="margin-top:-2px;"><i class="fas fa-check"></i></button>
                                            </form>
                                        </td>
                                        <td>{{ $cart->price }}</td>
                                        <td>{{ $cart->price * $cart->qty }}</td>
                                        <td><a href="{{ url('/cart_remove/' . $cart->rowId) }}"
                                                style="margin-top:-2px;"><i class="fas fa-trash-alt"
                                                    style="color:rgb(25, 7, 187)"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bg-blue">
                            <br>
                            <p style="font-size:18px; color:#fff ">Quantity : {{ Cart::count() }} Pcs</p>
                            <p style="font-size:18px; color:#fff ">SubTotal : {{ Cart::subtotal() }} Ks</p>
                            {{-- <p style="font-size:18px; color:#fff ">Tax : {{Cart::tax()}}</p> --}}
                            <p>
                            <h2 class="text-white">Total :</h2>
                            <h1 class="text-white">{{ Cart::total() }}</h1>
                            </p>
                            <br>
                        </div>
                    </div>
                    <form action="{{ url('create-invoice') }}" id="myForm" method="post">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="costomer" class="form-label">Add Customer</label>

                            <a href="{{ route('add#customer') }}"
                                class="btn btn-outline-blue rounded-pill waves-effect waves-light"><i
                                    class="fas fa-plus"></i></a>

                            <select name="customerId" class="form-select mt-3" id="example-select">
                                <option selected disabled>ဖေါက်သည် ရွေးချယ်ပါ...</option>
                                @foreach ($customers as $cust)
                                    <option value="{{ $cust->id }}">{{ $cust->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- end col -->
                        <button class="btn btn-blue waves-effect waves-light mb-3">အော်ဒါ အတည်ပြုရန်</button>
                    </form>

                </div> <!-- end card -->



            </div> <!-- end col-->

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="row">
                        <div class="dropdown">
                            <div class="col-sm-6">
                                <div class="dropdown mx-2 my-2">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        All Products <i class="mdi mdi-chevron-down"></i>
                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($categories as $cat)
                                        <a class="dropdown-item" href="{{ url('/category/search/' . $cat->id) }}">{{ $cat->category_name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-6 g-1">
                            @foreach ($product as $key => $item)
                                <form action="{{ url('/add-cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="hidden" name="porductName" value="{{ $item->product_name }}">
                                    <input type="hidden" name="qty" value="1">
                                    <input type="hidden" name="price" value="{{ $item->selling_price }}">

                                    <button type="submit">
                                        <div class="card my-2 bg-white" style="width:9em; height:12em;">
                                            <img class="card-img-top" src="{{ asset($item->product_image) }}">

                                            <div class="card-text text-danger mb-1">
                                                <p>{{ $item->product_name }}</p>
                                                <p>{{ $item->selling_price }} Ks</p>

                                            </div>

                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>

                    {{-- </div> --}}
                    <!-- end settings content-->

                    {{-- </div> --}}
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->


<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                customerId: {
                    required: true,
                },
            },
            messages: {
                customerId: {
                    required: 'ဖေါက်သည် ရွေးချယ်ပေးရန် လိုအပ်ပါသည်',
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
