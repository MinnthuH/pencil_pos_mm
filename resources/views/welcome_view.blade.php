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
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/PencilLogo.png') }}">

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

<body data-layout-mode="default" data-theme="dark" data-topbar-color="dark" data-menu-position="fixed"
    data-leftbar-color="dark" data-leftbar-size='default' data-sidebar-user='false'>

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        @include('body.header')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>

                <!-- User box -->

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul id="side-menu">


                            <li class="my-1">
                                <a href="#customer" data-bs-toggle="collapse">
                                    <i class="fas fa-bell"></i>
                                    <span> Notifications</span><span
                                        class="badge bg-danger rounded-circle noti-icon-badge ms-2">1</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="customer">
                                    <ul class="nav-second-level">
                                        {{-- @if (Auth::user()->can('customer.all'))
                                            <li>
                                                <a href="{{ route('all#customer') }}">ဖေါက်သည် စာရင်းများ</a>
                                            </li>
                                        @endif
                                        @if (Auth::user()->can('customer.add'))
                                            <li>
                                                <a href="{{ route('add#customer') }}">ဖေါက်သည် အသစ်ထည့်ရန်</a>
                                            </li>
                                        @endif --}}
                                    </ul>
                                </div>
                            </li>






                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>


        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">

            <div class="row justify-content-center mt-5">
                <div class="col-8">
                    <div class="row row-cols-1 row-cols-md-3 g-3 mb-2">
                        @if (Auth::user()->can('admin.manage'))
                            <div class="col">
                                <div class="custom-card mx-2">
                                    <div class="card-body text-center">
                                        <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                            src="{{ asset('backend/assets/icons/pie-chart.png') }}"
                                            alt="Card image cap">
                                        <a href="{{ route('admin.manage') }}" style="text-decoration: none">
                                            <h5 class="card-title mt-2">Owner Management</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col">
                            <div class="custom-card mx-2 mb-1">
                                <div class="card-body text-center">
                                    <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                        src="{{ asset('backend/assets/icons/cash-machine.png') }}"
                                        alt="Card image cap">
                                    <a href="{{ route('pos') }}" style="text-decoration: none">
                                        <h5 class="card-title mt-2">Cashier</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->can('admin.manage'))
                        <div class="col">
                            <div class="custom-card mx-2 mb-1">
                                <div class="card-body text-center">
                                    <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                        src="{{ asset('backend/assets/icons/monitor.png') }}" alt="Card image cap">
                                    <a href="{{ route('all#sale') }}" style="text-decoration: none">
                                        <h5 class="card-title mt-2">Reports</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col">
                            <div class="custom-card mx-2 mb-1">
                                <div class="card-body text-center">
                                    <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                        src="{{ asset('backend/assets/icons/dairy-products.png') }}"
                                        alt="Card image cap">
                                    <a href="{{ route('all#product') }}" style="text-decoration: none">
                                        <h5 class="card-title mt-2">Products</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->can('admin.manage'))
                        <div class="col">
                            <div class="custom-card mx-2 mb-1">
                                <div class="card-body text-center">
                                    <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                        src="{{ asset('backend/assets/icons/budget.png') }}" alt="Card image cap">
                                    <a href="{{ route('today#expense') }}" style="text-decoration: none">
                                        <h5 class="card-title mt-2">Expense</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col">
                            <div class="custom-card mx-2 mb-1">
                                <div class="card-body text-center">
                                    <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                        src="{{ asset('backend/assets/icons/warehouse.png') }}" alt="Card image cap">
                                    <a href="{{ route('manage#stock') }}" style="text-decoration: none">
                                        <h5 class="card-title mt-2">Product Stock</h5>
                                    </a>
                                </div>
                            </div>
                        </div>




                    </div> <!-- end card-column -->
                </div> <!-- end col -->
            </div> <!-- end row -->




            <!-- Footer Start -->
            @include('body.footer')
            <!-- end Footer -->

        </div>

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
