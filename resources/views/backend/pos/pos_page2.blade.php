@extends('admin_dashboard')

@section('admin')
@section('title')
    POS | Pencil POS System
@endsection
{{-- jquery link  --}}
{{-- <script src="{{ asset('backend/assets/jquery.js') }}"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="content">

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
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
                        <div class="bg-primary">
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
                        <button class="btn btn-primary waves-effect waves-light mb-3">အော်ဒါ အတည်ပြုရန်</button>
                    </form>

                </div> <!-- end card -->
            </div> <!-- end card -->
        </div> <!-- end col-->

        <div class="col-lg-8">
            <div class="card">
                <div class="input-group mb-3 mt-2">
                    <input type="text" class="form-control" id="productCodeInput" placeholder="Scan or type product code">
                    <button type="button" class="btn btn-primary" id="addToCartBtn">Add to Cart</button>
                </div>
                <div class="card-body pb-2">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            @foreach ($categories as $cat)
                                <a href="#" class="dropdown-item category-link"
                                    data-category-id="{{ $cat->id }}">{{ $cat->category_name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <h4 class="header-title mb-0">ကုန်ပစ္စည်းများ</h4>


                    <div class="row" id="product-list-container" >
                        @foreach ($products as $key => $item)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-3">
                                <form action="{{ url('/add-cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="hidden" name="porductName" value="{{ $item->product_name }}">
                                    <input type="hidden" name="qty" value="1">
                                    <input type="hidden" name="price" value="{{ $item->selling_price }}">

                                    <button type="submit" class="btn btn-link">
                                        <div class="card" style="width: 8.5rem;">
                                            <img src="{{ asset($item->product_image) }}" id="em_photo"
                                                class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->product_name }}</h5>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->

    </div>
    <!-- end row -->



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

<!-- At the end of your Blade template -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.category-link').on('click', function(event) {
            event.preventDefault();

            var categoryId = $(this).data('category-id');

            $.ajax({
                url: '/get-products-by-category/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the product list in the DOM with the new data
                    displayProducts(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // Function to display products in the DOM
        function displayProducts(products) {
            var productListHtml = '';
            $.each(products, function(index, product) {
                productListHtml += `
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-3">
                        <form action="{{ url('/add-cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="${product.id}">
                            <input type="hidden" name="porductName" value="${product.product_name}">
                            <input type="hidden" name="qty" value="1">
                            <input type="hidden" name="price" value="${product.selling_price}">
                            <button type="submit" class="btn btn-link">
                                <div class="card" style="width: 8.5rem;">
                                    <img src="${product.product_image}" id="em_photo" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">${product.product_name}</h5>
                                    </div>
                                </div>
                            </button>
                        </form>
                    </div>
                `;
            });

            // Update the product list container with the new HTML
            $('#product-list-container').html(productListHtml);
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#addToCartBtn').on('click', function() {
            var productCode = $('#productCodeInput').val();

            // Perform an AJAX request to get the product details based on the code
            $.ajax({
                url: '/get-product-by-code/' + productCode,
                type: 'GET',
                dataType: 'json',
                success: function(product) {
                    if (product) {
                        // Add the product to the cart
                        $.ajax({
                            url: '/add-cart',
                            type: 'POST',
                            data: {
                                id: product.id,
                                porductName: product.product_name,
                                qty: 1, // You can set the quantity as per your requirement
                                price: product.selling_price,
                                _token: '{{ csrf_token() }}',
                            },
                            dataType: 'json',
                            success: function(response) {
                                // Show a success message or notification if needed
                                alert('Product added to cart successfully!');
                                // You can also update the cart summary section here if needed
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    } else {
                        alert('Product not found! Please check the product code.');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>



<style type="text/css">
    #em_photo {
        height: 40px;
        width: 40px;
    }

    .image-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Adjust the values to your preference */
        /* Other styles for the card go here */
    }
</style>

@endsection
