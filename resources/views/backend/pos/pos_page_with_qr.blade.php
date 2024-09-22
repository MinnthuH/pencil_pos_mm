@extends('admin_dashboard')

@section('admin')
@section('title')
    POS | Pencil POS System
@endsection
{{-- jquery link  --}}
<script src="{{ asset('backend/assets/jquery.js') }}"></script>

<style type="text/css">
    /* CSS for the search input field */
    /* #searchInput {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    } */

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
        <div class="col-lg-4 fixed-col">
            <div class="card">
                <div class="card text-center">
                    <div class="card-body">

                        <table class="table table-bordered border-dark mb-0">
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
                        <div class="bg-dark">
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

                        <div class="form-group m-2">
                            <select name="customerId" class="form-select mt-3" id="example-select">
                                <option selected disabled>ဖေါက်သည် ရွေးချယ်ပါ...</option>
                                @foreach ($customers as $cust)
                                    <option value="{{ $cust->id }}">{{ $cust->name }}</option>
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
                    <div class="mb-3 d-flex justify-content-center mt-3">
                        <input type="text" class="form-control w-50" id="searchInput"
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
                                                    <span
                                                        class="badge bg-dark">{{ $item->selling_price }}&nbsp;ks</span>
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

        // function displayProducts(productsData) {
        //     var productListHtml = '';
        //     $.each(productsData, function(index, product) {
        //         let productCodesHtml = '';

        //         try {
        //             let productCodes = JSON.parse(product.product_code);
        //             if (Array.isArray(productCodes)) {
        //                 productCodesHtml = productCodes.join('<br>');
        //             } else {
        //                 productCodesHtml = product.product_code;
        //             }
        //         } catch (error) {
        //             console.error('Error parsing product codes: ', error);
        //             productCodesHtml = product.product_code;
        //         }
        //         productListHtml += `
        // <div class="col-lg-3 col-md-3 col-sm-6 col-6 mt-3">
        //     <form action="{{ url('/add-cart') }}" method="post" class="product-form">
        //         @csrf
        //         <input type="hidden" name="id" value="${product.id}">
        //         <input type="hidden" name="porductName" value="${product.product_name}">
        //         <input type="hidden" name="buyPrice" value="${product.buy_price}">
        //         <input type="hidden" name="qty" value="1">
        //         <input type="hidden" name="price" value="${product.selling_price}">
        //         <button type="submit" class="btn btn-link categor_submit">
        //             <div class="card" style="width: 8.5rem;">
        //                 <img src="${product.product_image ? product.product_image : '{{ asset('upload/no_image.jpg') }}'}" id="em_photo" class="card-img-top">
        //                 <div class="card-body">
        //                     <h5 class="card-title">${product.product_name}</h5>
        //                     <h5 class="card-title" style="display:">${productCodesHtml}</h5>
        //                     <span class="badge bg-dark">${product.selling_price}&nbsp;ks</span>
        //                 </div>
        //                 <span class="badge bg-primary position-absolute top-0 end-0">${product.quantity}</span>
        //             </div>
        //         </button>
        //     </form>
        // </div>
        // `;
        //     });
        //     $('#product-list-container').html(productListHtml);
        // }

        function updateProductsAndPagination(data) {
            products = data.data;
            currentPage = data.current_page;
            lastPage = data.last_page;
            displayProducts(products);
        }

        // Initial function call to update products and pagination
        updateProductsAndPagination(@json($products));

        // Category link click event to fetch products by category
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
                let productCodes = [];
                try {
                    productCodes = JSON.parse(product.product_code);
                    if (!Array.isArray(productCodes)) {
                        productCodes = [productCodes];
                    }
                } catch (error) {
                    console.error('Error parsing product codes: ', error);
                    productCodes = [product.product_code];
                }

                return (
                    product.product_name.toLowerCase().includes(searchTerm) ||
                    productCodes.some(code => typeof code === 'string' && code.toLowerCase()
                        .includes(searchTerm))
                );
            });

            displayProducts(filteredProducts);

            products.forEach(function(product) {
                let productCodes = [];

                try {
                    productCodes = JSON.parse(product.product_code);

                    if (!Array.isArray(productCodes)) {
                        productCodes = [productCodes];
                    }
                } catch (error) {
                    console.error('Error parsing product codes: ', error);
                    productCodes = [product.product_code];
                }

                if (productCodes.some(code => typeof code === 'string' && searchTerm === code
                        .toLowerCase())) {
                    $('input[value="' + product.id + '"]').closest('form').find(
                        '.categor_submit').click();
                    console.log('hello');
                }
            });
        });

        function displayProducts(productsData) {
            var productListHtml = '';

            $.each(productsData, function(index, product) {
                let productCodesHtml = '';

                try {
                    let productCodes = JSON.parse(product.product_code);
                    if (Array.isArray(productCodes)) {
                        productCodesHtml = productCodes.join('<br>');
                    } else {
                        productCodesHtml = product.product_code;
                    }
                } catch (error) {
                    console.error('Error parsing product codes: ', error);
                    productCodesHtml = product.product_code;
                }

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
        <img src="${product.product_image ? product.product_image : '{{ asset('upload/no_image.jpg') }}'}" class="card-img-top" style="width: 100%; height: 100px;">
        <div class="card-body">
            <h5 class="card-title">${product.product_name}</h5>
            <h5 class="card-title" style="display: none;">${productCodesHtml}</h5>
            <span class="badge bg-dark">${product.selling_price}&nbsp;ks</span>
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


        // $('#myForm').validate({
        //     rules: {
        //         customerId: {
        //             required: true,
        //         },
        //     },
        //     messages: {
        //         customerId: {
        //             required: 'ဖေါက်သည် ရွေးချယ်ပေးရန် လိုအပ်ပါသည်',
        //         },
        //     },
        //     errorElement: 'span',
        //     errorPlacement: function(error, element) {
        //         error.addClass('invalid-feedback');
        //         element.closest('.form-group').append(error);
        //     },
        //     highlight: function(element, errorClass, validClass) {
        //         $(element).addClass('is-invalid');
        //     },
        //     unhighlight: function(element, errorClass, validClass) {
        //         $(element).removeClass('is-invalid');
        //     },
        // });
    });
</script>



@endsection
