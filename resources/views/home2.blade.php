<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    {{-- jquery  --}}
    <script src="{{ asset('backend/assets/jquery.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('backend/assets/css/home.css') }}">


</head>

<body>

    <nav class="navbar navbar-light bg-dark">
        <div class="container-fluid">
            <div class="logo-box">
                <a href="#" class="logo logo-light text-center">
                    <img src="{{ asset('backend/assets/images/PencilLogo.png') }}" alt="" height="40">
                </a>
            </div>
            <div class="d-flex flex-grow-1 justify-content-center align-items-center">
                @if (Auth::user()->shop)
                    <h2 class="text-light d-none d-lg-block mb-0">Welcome {{ Auth::user()->shop->name }}<span></span>
                        Shop</h2>
                @else
                    <h2 class="text-light d-none d-lg-block mb-0">Welcome</h2>
                @endif
            </div>
            <div class="d-flex">
                @if (Auth::check())
                    <h5 class="me-2 text-light">{{ Auth::user()->name }}</h5>
                    <a href="{{ route('admin#logout') }}"><span class="btn btn-outline-primary">Logout</span></a>
                @endif
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-5 mt-4">
            @if (Auth::user()->can('admin.manage'))
                <div class="col">
                    <div class="card rounded-card bg-secondary">
                        <a href="{{ route('admin.manage') }}">
                            <div class="card-body">
                                <img src="{{ asset('backend/assets/icons/pie-chart.png') }}" alt="image"
                                    class="card-img-top" style="width: 8rem">
                                <h5 class="card-title text-white font-18">စီမံခန့်ခွဲမှုများ</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="card rounded-card bg-secondary">
                    <a href="{{ route('pos') }}" style="text-decoration: none">
                        <div class="card-body">
                            <img src="{{ asset('backend/assets/icons/cash-machine.png') }}" alt="image"
                                class="card-img-top" style="width: 8rem">
                            <h5 class="card-title text-white font-18">အရောင်းဆိုင်ရာ</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card rounded-card bg-secondary">
                    <a href="{{ route('all#sale', Auth::user()->shop_id) }}" style="text-decoration: none">
                        <div class="card-body">
                            <img src="{{ asset('backend/assets/icons/monitor.png') }}" alt="image"
                                class="card-img-top" style="width: 8rem">
                            <h5 class="card-title text-white font-18">အရောင်းစာရင်းများ</h5>
                        </div>
                    </a>
                </div>
            </div>
            @if (Auth::user()->can('admin.manage'))
                <div class="col">
                    <div class="card rounded-card bg-secondary">
                        <a href="{{ route('pending.due') }}" style="text-decoration: none">
                            <div class="card-body">
                                <img src="{{ asset('backend/assets/icons/payment-method.png') }}" alt="image"
                                    class="card-img-top" style="width: 8rem">
                                <h5 class="card-title text-white font-18">အကြွေးစာရင်း</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @if (Auth::user()->can('admin.manage'))
                <div class="col">
                    <div class="card rounded-card bg-secondary">
                        <a href="{{ route('all#product') }}" style="text-decoration: none">
                            <div class="card-body">
                                <img src="{{ asset('backend/assets/icons/dairy-products.png') }}" alt="image"
                                    class="card-img-top" style="width: 8rem">
                                <h5 class="card-title text-white font-18">ကုန်ပစ္စည်းအချက်အလက်များ</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @if (Auth::user()->can('admin.manage'))
                <div class="col">
                    <div class="card rounded-card bg-secondary">
                        <a href="{{ route('today#expense') }}" style="text-decoration: none">
                            <div class="card-body">
                                <img src="{{ asset('backend/assets/icons/budget.png') }}" alt="image"
                                    class="card-img-top" style="width: 8rem">
                                <h5 class="card-title text-white font-18">ထွက်ငွေများ</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="card rounded-card bg-secondary">
                    <a href="{{ route('shop.stock', Auth::user()->shop_id) }}" style="text-decoration: none">
                        <div class="card-body">
                            <img src="{{ asset('backend/assets/icons/warehouse.png') }}" alt="image"
                                class="card-img-top" style="width: 8rem">
                            <h5 class="card-title text-white font-18">ကုန်ပစ္စည်းလက်ကျန်စာရင်း</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card rounded-card bg-secondary">
                    <a href="{{ route('noti.expire') }}" style="text-decoration: none">
                        <div class="card-body">
                            <img src="{{ asset('backend/assets/icons/calendar.png') }}" alt="image"
                                class="card-img-top" style="width: 8rem">
                            <h5 class="card-title text-white font-18">Expire သတိပေးစာရင်း</h5>
                        </div>
                    </a>
                </div>
            </div>



        </div>
</body>
<!-- App js-->
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
<!-- Vendor js -->
<script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>
<!-- Plugins js-->
<script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ asset('backend/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- App js-->
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>


</html>
