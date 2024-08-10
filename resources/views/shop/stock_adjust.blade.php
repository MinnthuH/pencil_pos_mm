@extends('admin_dashboard')

@section('admin')
@section('title')
    Stock Adjust | Pencil POS System
@endsection
{{-- jquery link  --}}
<script src="{{ asset('backend/assets/jquery.js') }}"></script>

<style type="text/css">
    /* CSS for the search input field */
    #searchInput {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    /* CSS for the product cards */
    .col-lg-3.col-md-3.col-sm-6.col-6.mt-3 {
        /* Adjust the card styling as per your design */
    }

    /* CSS for the right column (scrollable area) */
    .scrollable-col {
        height: calc(100vh - 130px);
        overflow-y: auto;
    }

    /* CSS for the left column (fixed position) */
    .fixed-col {
        position: sticky;
        top: 20px;
        height: calc(100vh - 170px);
        overflow-y: auto;
    }

    #em_photo {
        height: 70px;
        width: 50px;
    }

    .image-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title ms-5">{{$shop->name}}Stock Adjustment</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 fixed-col">
            <div class="card">
                <div class="card text-center">
                    <div class="card-body">
                        <table class="table table-bordered border-dark mb-0">
                            <thead>
                                <tr class="bg-secondary text-white">
                                    <th>Name</th>
                                    <th>QTY</th>
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
                                            <form action="{{ url('/stock/cart_update/' . $cart->rowId) }}" method="post">
                                                @csrf
                                                <input type="number" name="qty" style="width:40px;" min="1"
                                                    value="{{ $cart->qty }}">
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    style="margin-top:-2px;"><i class="fas fa-check"></i></button>
                                            </form>
                                        </td>

                                        <td><a href="{{ url('/stock/cart_remove/' . $cart->rowId) }}"
                                                style="margin-top:-2px;"><i class="fas fa-trash-alt"
                                                    style="color:rgb(25, 7, 187)"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <form action="{{ url('create/adjust') }}" id="myForm" method="post">
                        @csrf

                        <input type="hidden" value="{{$shop->id}}" name="originalShop" >
                        <div class="form-group m-2">
                            <select name="shopId" class="form-select mt-3" id="example-select">
                                <option selected disabled>Please Choose Shop</option>
                                @foreach ($shops as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-dark waves-effect waves-light mb-3">အော်ဒါ အတည်ပြုရန်</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8 scrollable-col">
            <div class="card">
                <div class="card-body pb-2">
                    <div class="dropdown float-end">
                        <a href="" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="#" class="dropdown-item category-link active" data-category-id="0">All
                                Products</a>
                            @foreach ($categories as $cat)
                                <a href="#" class="dropdown-item category-link"
                                    data-category-id="{{ $cat->id }}">{{ $cat->category_name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="searchInput"
                            placeholder="Search products by name, code, or scan barcode" autofocus>
                    </div>
                    <h4 class="header-title mb-0">ကုန်ပစ္စည်းများ</h4>

                    <div class="row" id="product-list-container">
                        @foreach ($products as $key => $item)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-3">
                                <form action="{{ url('/add-cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="hidden" name="porductName" value="{{ $item->product_name }}">
                                    <input type="hidden" name="buyPrice" value="{{ $item->buy_price }}">
                                    <input type="hidden" name="qty" value="1">
                                    <input type="hidden" name="price" value="{{ $item->selling_price }}">

                                    <button type="submit" class="btn btn-link">
                                        <div class="card" style="width: 8.5rem;">
                                            <div class="position-relative">
                                                <img src="{{ asset($item->product_image ?: 'upload/no_image.jpg') }}"
                                                    alt="Product Image" class="img-fluid">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $item->product_name }}</h5>

                                                </div>
                                                <span class="badge bg-primary position-absolute top-0 end-0">
                                                    {{ $item->quantity }}
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div id="pagination-container">
                                {{ $products->links('vendor.pagination.custom_peginate') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var products = [];
        var currentPage = 1;
        var lastPage = 1;

        function displayProducts(productsData) {
            var productListHtml = '';
            $.each(productsData, function(index, product) {
                productListHtml += `
                <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-3">
                    <form action="{{ url('/add-cart') }}" method="post" class="product-form">
                        @csrf
                        <input type="hidden" name="id" value="${product.id}">
                        <input type="hidden" name="porductName" value="${product.product_name}">
                        <input type="hidden" name="buyPrice" value="${product.buy_price}">
                        <input type="hidden" name="qty" value="1">
                        <input type="hidden" name="price" value="${product.selling_price}">
                        <button type="submit" class="btn btn-link categor_submit">
                            <div class="card" style="width: 8.5rem;">
                                <img src="${product.product_image ? product.product_image : '{{ asset('upload/no_image.jpg') }}'}" id="em_photo" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">${product.product_name}</h5>
                                    <h5 class="card-title" style="display: none">${product.product_code}</h5>

                                </div>
                                <span class="badge bg-primary position-absolute top-0 end-0">${product.quantity}</span>
                            </div>
                        </button>
                    </form>
                </div>
                `;
            });
            $('#product-list-container').html(productListHtml);
        }

        function updateProductsAndPagination(data) {
            products = data.data;
            currentPage = data.current_page;
            lastPage = data.last_page;
            displayProducts(products);
        }

        updateProductsAndPagination(@json($products));

        $('.category-link').on('click', function(event) {
            event.preventDefault();
            var categoryId = $(this).data('category-id');

            $.ajax({
                url: "{{ url('get-products-by-category') }}" + "/" + categoryId,
                type: "GET",
                success: function(response) {
                    updateProductsAndPagination(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#searchInput').on('input', function() {
            var searchTerm = $(this).val().trim().toLowerCase();
            var filteredProducts = products.filter(function(product) {
                return (
                    product.product_name.toLowerCase().includes(searchTerm) ||
                    product.product_code.toLowerCase().includes(searchTerm)
                );
            });

            displayProducts(filteredProducts);

            // Check if the search term matches any product code and submit the form if it does
            products.forEach(function(product) {
                if (searchTerm === product.product_code.toLowerCase()) {
                    $('input[value="' + product.id + '"]').closest('form').find(
                        '.categor_submit').click();
                }
            });
        });

        $('#searchInput').on('input', function() {
            var searchTerm = $(this).val().trim().toLowerCase();

            if (searchTerm.length === 12 && !isNaN(searchTerm)) {
                var barcode = searchTerm;
                var product = products.find(function(product) {
                    return product.product_code === barcode;
                });

                if (product) {
                    $('#product-list-container').empty();
                    displayProducts([product]);
                } else {
                    $('#product-list-container').empty();
                    $('#product-list-container').html(
                        '<p>No product found for the scanned barcode.</p>');
                }
            } else {
                var filteredProducts = products.filter(function(product) {
                    return (
                        product.product_name.toLowerCase().includes(searchTerm) ||
                        product.product_code.toLowerCase().includes(searchTerm)
                    );
                });

                $('#product-list-container').empty();
                displayProducts(filteredProducts);
            }
        });

        $('#myForm').validate({
             rules: {
                shopId: {
                     required: true,
                 },
             },
             messages: {
                shopId: {
                     required: 'လွှဲပြောင်းမည့်ဆိုင် ရွေးချယ်ပေးရန် လိုအပ်ပါသည်',
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
<input type="text" class="form-control" id="searchInput" placeholder="Search products by name, code, or scan barcode"
    autofocus>


@endsection
