<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Home | Pencil POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- icons -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{ asset('backend/assets/js/head.js') }}"></script>

</head>

<div class="navbar-custom">
    <div class="">
        <ul class="list-unstyled topnav-menu float-end mb-0">


            @php
                $id = Auth::user()->id;
                $adminData = App\Models\User::find($id);
            @endphp

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ !empty($adminData->photo) ? url('upload/admin_images/' . $adminData->photo) : url('upload/no_image.jpg') }}"
                        alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ms-1">
                        {{ $adminData->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('admin#profile') }}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('admin#changepassword') }}" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Change Password</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{ route('admin#logout') }}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>

        </ul>


    </div>
</div>

<body class="bg-secondary">

    <div class="row justify-content-center mt-5">
        <div class="col-12">
            <div class="row row-cols-1 row-cols-md-3 g-3 mb-2">
                @if (Auth::user()->can('admin.manage'))
                    <div class="col">
                        <div class="custom-card mx-2">
                            <div class="card-body text-center">

                                <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                    src="{{ asset('backend/assets/icons/pie-chart.png') }}" alt="Card image cap">
                                </a>
                                <h5 class="card-title mt-2">စီမံခံခွဲမှု ဆိုင်ရာများ</h5>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col">
                    <div class="custom-card mx-2 mb-1">
                        <div class="card-body text-center">
                            <a href="{{ route('pos') }}" style="text-decoration: none">
                                <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                    src="{{ asset('backend/assets/icons/cash-machine.png') }}" alt="Card image cap">

                            </a>
                            <h5 class="card-title mt-2">အရောင်း</h5>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->can('admin.manage'))
                    <div class="col">
                        <div class="custom-card mx-2 mb-1">
                            <div class="card-body text-center">

                                <a href="{{ route('all#sale') }}" style="text-decoration: none">
                                    <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                        src="{{ asset('backend/assets/icons/monitor.png') }}" alt="Card image cap">
                                </a>
                                <h5 class="card-title mt-2">အရောင်းစာရင်းများ</h5>
                            </div>
                        </div>
                    </div>
                @endif
                @if (Auth::user()->can('admin.manage'))
                    <div class="col">
                        <div class="custom-card mx-2 mb-1">
                            <div class="card-body text-center">
                                <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                    src="{{ asset('backend/assets/icons/payment-method.png') }}" alt="Card image cap">
                                <a href="{{ route('pending.due') }}" style="text-decoration: none">
                                    <h5 class="card-title mt-2">အကြွေးစာရင်း</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col">
                    <div class="custom-card mx-2 mb-1">
                        <div class="card-body text-center">
                            <a href="{{ route('all#product') }}" style="text-decoration: none">
                            <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                src="{{ asset('backend/assets/icons/dairy-products.png') }}" alt="Card image cap">
                            </a>
                            <h5 class="card-title mt-2">ကုန်ပစ္စည်းအချက်အလက်များ</h5>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->can('admin.manage'))
                    <div class="col">
                        <div class="custom-card mx-2 mb-1">
                            <div class="card-body text-center">
                                <a href="{{ route('today#expense') }}" style="text-decoration: none">
                                <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                    src="{{ asset('backend/assets/icons/budget.png') }}" alt="Card image cap">
                                </a>
                                <h5 class="card-title mt-2">ထွက်ငွေများ</h5>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col">
                    <div class="custom-card mx-2 mb-1">
                        <div class="card-body text-center">
                            <a href="{{ route('manage#stock') }}" style="text-decoration: none">
                            <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                src="{{ asset('backend/assets/icons/warehouse.png') }}" alt="Card image cap">
                            </a>
                            <h5 class="card-title mt-2">ကုန်ပစ္စည်းလက်ကျန်စာရင်း</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="custom-card mx-2 mb-1">
                        <div class="card-body text-center">
                            <a href="{{ route('noti.expire') }}" style="text-decoration: none">
                            <img class="card-img-top img-fluid mx-auto" style="width: 10rem"
                                src="{{ asset('backend/assets/icons/calendar.png') }}" alt="Card image cap">
                            </a>
                            <h5 class="card-title mt-2">Expire သတိပေးစာရင်း</h5>
                        </div>
                    </div>
                </div>




            </div> <!-- end card-column -->
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- end page -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> &copy; Beth by <a href="">pencilitsolutions</a>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end footer-links d-none d-sm-block">
                        <a href="javascript:void(0);">About Us</a>
                        <a href="javascript:void(0);">Help</a>
                        <a href="javascript:void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vendor js -->
    <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

</body>

</html>
