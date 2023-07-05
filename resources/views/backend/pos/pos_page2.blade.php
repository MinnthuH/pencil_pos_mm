<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- datatable  start-->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- datatable  end -->

    <!-- Plugins css -->
    <link href="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- toastr css -->
    <link href="{{ asset('backend/assets/toastr.css') }}" rel="stylesheet" type="text/css" />

    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}

    <!-- Bootstrap css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- icons -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{ asset('backend/assets/js/head.js') }}"></script>

    {{-- tostr.css  --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/toastr.css') }}">


</head>

<!-- body start -->

<body data-layout-mode="default" data-theme="light" data-topbar-color="dark" data-menu-position="fixed"
    data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        @include('body.header')
        <!-- end Topbar -->


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">POS</a></li>

                            </ol>
                        </div>
                        <h4 class="page-title">POS</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-6 col-xl-6">
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
                                                <form action="{{ url('/cart_update/' . $cart->rowId) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="number" name="qty" style="width:40px;"
                                                        min="1" value="{{ $cart->qty }}">
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        style="margin-top:-2px;"><i
                                                            class="fas fa-check"></i></button>
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
                                    <option selected disabled>Select Customer</option>
                                    @foreach ($customers as $cust)
                                        <option value="{{ $cust->id }}">{{ $cust->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- end col -->
                            <button class="btn btn-blue waves-effect waves-light mb-3">Create Invoice</button>
                        </form>

                    </div> <!-- end card -->



                </div> <!-- end col-->

                <div class="col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">


                            <div class="tab-pane" id="settings">
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th></th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $key => $item)
                                            <tr>
                                                <form action="{{ url('/add-cart') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ $item->id }}">
                                                    <input type="hidden" name="porductName"
                                                        value="{{ $item->product_name }}">
                                                    <input type="hidden" name="qty" value="1">
                                                    <input type="hidden" name="price"
                                                        value="{{ $item->selling_price }}">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><img src="{{ asset($item->product_image) }}"
                                                            style="width:50px;height:40px;" alt=""></td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td><button type="submit"
                                                            style="font-size: 20px; color:#0d37f3;"><i
                                                                class="fas fa-plus-square"></i></button></td>

                                                </form>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <!-- end settings content-->

                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    @include('body.right_sidebar')
    <!-- /Right-bar -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('backend/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{ asset('backend/assets/js/pages/dashboard-1.init.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

    {{-- tostr js  --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('backend/assets/js/toastr.min.js') }}"></script>

    <!-- Datatable  js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- Datatable  js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>

    {{-- sweet alert  --}}
    <script src="{{ asset('backend/assets/js/sweetalert2@10.js') }}"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
    {{-- validate js  --}}
    <script src="{{ asset('backend/assets/js/validate.min.js') }}"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>



</body>

</html>
