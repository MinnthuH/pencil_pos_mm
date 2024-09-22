@extends('admin_dashboard')

@section('admin')
@section('title')
    Stock Import to Warehouse | Pencil POS System
@endsection
{{-- jquery link  --}}
<script src="{{ asset('backend/assets/jquery.js') }}"></script>


<style type="text/css">
    #searchInput {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    .scrollable-col {
        height: calc(100vh - 130px);
        overflow-y: auto;
    }

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

    /* Responsive cart table */
    .table thead th {
        font-size: 1rem;
    }

    .table tbody td {
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .btn-update {
        padding: 4px 8px;
        font-size: 0.875rem;
    }

    .btn-remove {
        font-size: 1rem;
        color: #ff4d4d;
    }

    /* Custom styling for small screens */
    @media (max-width: 576px) {
        .table-responsive {
            margin-bottom: 1rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            white-space: nowrap;
        }
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h2 class="page-title ms-2">Stockin to Warehouse</h2>
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
                                                <input type="number" name="qty" style="width:50px;" min="1" value="{{ $cart->qty }}">
                                                <button type="submit" class="btn btn-sm btn-success btn-update">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ url('/stock/cart_remove/' . $cart->rowId) }}" class="btn-remove">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="bg-dark">
                            <br>
                            <p style="font-size:18px; color:#fff ">Quantity : {{ Cart::count() }} Pcs</p>

                            <br>
                        </div> --}}
                    </div>
                    <form action="{{ url('/create-import/order') }}" id="myForm" method="post">
                        @csrf
                        <div class="form-group m-2">

                            <input type="hidden" name="shopId" value="{{$shopId}}">
                            {{-- <select name="shopId" class="form-select mt-3" id="example-select">
                                <option selected disabled>Please Select Shop</option>
                                @foreach ($shops as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select> --}}
                        </div>

                        <button class="btn btn-dark waves-effect waves-light mb-3">Confirm Order</button>
                    </form>

                </div> <!-- end card -->
            </div> <!-- end card -->
        </div> <!-- end col-->

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
                                <form action="{{ url('stocks/add-cart') }}" method="post">
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
                                                <!-- Add position-relative class to the card container -->
                                                {{-- @if (!empty($item->product_image))
                                                    <img src="{{ asset($item->product_image) }}" id="em_photo"
                                                        class="card-img-top">
                                                @else
                                                    <img src="{{ asset('upload/no_image.jpg') }}" id="em_photo"
                                                        class="card-img-top">
                                                @endif --}}
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $item->product_name }}</h5>
                                                    {{-- <span
                                                        class="badge bg-dark">{{ $item->selling_price }}&nbsp;ks</span> --}}
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Example: Display product_image value for debugging -->
                                        <p>Product Image Path: {{ $item->product_image }}</p>


                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div id="pagination-container">
                                {{ $products->links('vendor.pagination.custom_peginate') }}
                            </div> <!-- end col-->
                        </div>
                    </div>
                    <!-- end row-->

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
                shopId: {
                    required: true,
                },
            },
            messages: {
                shopId: {
                    required: 'ဆိုင်ရွေးချယ်ပေးရန် လိုအပ်ပါသည်',
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




{{-- update script  --}}

<script>
    $(document).ready(function() {
        // Define variables to hold products and pagination data
        var products = [];
        var currentPage = 1; // Initialize with the default page number
        var lastPage = 1; // Initialize with the default last page number

        // Function to display products based on the provided data
        function displayProducts(productsData) {
            var productListHtml = '';
            $.each(productsData, function(index, product) {
                // Create HTML for each product card
                productListHtml += `
                <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-3">
                <form action="{{ url('stocks/add-cart') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="${product.id}">
                    <input type="hidden" name="porductName" value="${product.product_name}">
                    <input type="hidden" name="buyPrice" value="${product.buy_price}">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" value="${product.selling_price}">
                    <button type="submit" class="btn btn-link">
                        <div class="card" style="width: 8.5rem;">


                            <img src="${product.product_image ? product.product_image : '{{ asset('upload/no_image.jpg') }}'}" id="em_photo" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">${product.product_name}</h5>

                            </div>

                        </div>
                    </button>
                </form>
            </div>
                `;
            });

            $('#product-list-container').html(productListHtml);
        }


        // Function to update products and pagination data
        function updateProductsAndPagination(data) {
            products = data.data; // Update products with data
            currentPage = data.current_page;
            lastPage = data.last_page;

            // Display products
            displayProducts(products);
        }

        // Initial display of products on page load
        updateProductsAndPagination(@json($products));

        $('.category-link').on('click', function(event) {
            event.preventDefault();
            var categoryId = $(this).data('category-id');

            $.ajax({
                url: "{{ url('get-products-by-category') }}" + "/" + categoryId,
                type: "GET",
                success: function(response) {
                    // Update products and pagination data
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

            // Display filtered products
            displayProducts(filteredProducts);
        });

        // Your pagination logic here

    });
</script>


@endsection
