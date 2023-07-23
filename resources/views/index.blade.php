@extends('admin_dashboard')


@section('admin')

    @php
        $currentDate = Carbon\Carbon::now()->format('Y-m-d');
        $todayPaid = App\Models\Sale::whereDate('invoice_date', $currentDate)->sum('sub_total');
        $todayCapital = App\Models\Sale::whereDate('invoice_date', $currentDate)->sum('capital');
        $todaySale = App\Models\Sale::whereDate('invoice_date', $currentDate)->get();
        $profit = $todayPaid - $todayCapital;

        // Get the start and end dates of the current week
        $startDate = date('Y-m-d', strtotime('last Monday'));
        $endDate = date('Y-m-d', strtotime('next Sunday'));

        // Calculate the sum of payments for the current week
        $weeklyPaid = App\Models\Sale::whereBetween('invoice_date', [$startDate, $endDate])->sum('sub_total');
        $weeklyCapital = App\Models\Sale::whereBetween('invoice_date', [$startDate, $endDate])->sum('capital');
        $weeklyProfit = $weeklyPaid - $weeklyCapital;

        // Get the current month and year
        $currentMonth = Carbon\Carbon::now()->format('m');
        $currentYear = Carbon\Carbon::now()->format('Y');

        // Calculate the sum of payments for the current month
        $monthlyPaid = App\Models\Sale::whereMonth('invoice_date', $currentMonth)
            ->whereYear('invoice_date', $currentYear)
            ->sum('sub_total');
        $monthlyCapital = App\Models\Sale::whereMonth('invoice_date', $currentMonth)->sum('capital');
        $monthlyProfit = $monthlyPaid - $monthlyCapital;

        // Calculate the sum of payments for the current year
        $yearlyPaid = App\Models\Sale::whereYear('invoice_date', $currentYear)->sum('sub_total');
        $yearlyCapital = App\Models\Sale::whereYear('invoice_date', $currentYear)->sum('capital');
        $yearlyProfit = $yearlyPaid - $yearlyCapital;

        $totalPaid = App\Models\Order::sum('pay');
        $totalDue = App\Models\Order::sum('due');

        $completeOrder = App\Models\Order::where('order_status', 'complete')->get();
        $pendingOrder = App\Models\Order::where('order_status', 'pending')->get();
        $sales = App\Models\Sale::orderBy('id', 'DESC')->get();
    @endphp

    <div class="content">
    @section('title')
        Dashboard | Pencil POS System
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    {{-- <div class="page-title-right">
                        <form class="d-flex align-items-center mb-3">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control border-0" id="dash-daterange">
                                <span class="input-group-text bg-blue border-blue text-white">
                                    <i class="mdi mdi-calendar-range"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div> --}}
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                                    <i class="fe-heart font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span
                                            data-plugin="counterup">{{ number_format($todayPaid) }}</span>&nbsp;Ks</h3>
                                    <p class="text-muted mb-1 text-truncate">ယနေ့ ရောင်းရငွေ</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                                    <i class="fe-shopping-cart font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span
                                            data-plugin="counterup">{{ number_format($weeklyPaid) }}</span>&nbsp;Ks</h3>
                                    <p class="text-muted mb-1 text-truncate">ယခုအပတ် ရောင်းရငွေ</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                                    <i class="fe-bar-chart-line- font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span
                                            data-plugin="counterup">{{ number_format($monthlyPaid) }}</span>&nbsp;Ks
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">ယခုလ ရောင်းရငွေ</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                                    <i class="fe-eye font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span
                                            data-plugin="counterup">{{ $totalDue }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">ရရန်ရှိငွေ</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>

                        <h4 class="header-title mb-0">Total Revenue</h4>

                        <div class="widget-chart text-center" dir="ltr">

                            {{-- <div id="total-revenue" class="mt-0"  data-colors="#f1556c"></div> --}}

                            <h5 class="text-muted mt-0">ယနေ့ အမြတ်ငွေ</h5>
                            <h2>{{ number_format($profit) }}&nbsp;Ks</h2>

                            <p class="text-muted w-75 mx-auto sp-line-2"></p>

                            <div class="row mt-3">
                                <div class="col-4">
                                    <p class="text-muted font-15 mb-1 text-truncate">ယခုအပတ် အမြတ်ငွေ</p>
                                    <h4>{{ number_format($weeklyProfit) }}&nbsp;Ks</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted font-15 mb-1 text-truncate">ယခုလ အမြတ်ငွေ</p>
                                    <h4>{{ number_format($monthlyProfit) }} Ks</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted font-15 mb-1 text-truncate">ယခုနှစ် အမြတ်ငွေ</p>
                                    <h4>{{ number_format($yearlyProfit) }} ks</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col-->


            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>

                        <h3 class="header-title mb-3">အရောင်းစာရင်းများ</h3>

                        <div class="table-responsive">
                            <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                                <thead class="table-light">
                                    <tr>
                                        <th>စဉ်</th>
                                        <th>အရောင်းဝန်ထမ်း</th>
                                        <th>ဘောင်ချာ နေ့စွဲ</th>
                                        <th>ဘောင်ချာ နံပါတ်</th>
                                        <th>ငွေပေးချေမှု ပုံစံ</th>
                                        <th>ကျသင့်ငွေ</th>
                                        <th>ပေးငွေ</th>
                                        <th>ပြန်အမ်းငွေ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($sales as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item['user']['name'] }}</td>
                                            <td>{{ $item->invoice_date }}</td>
                                            <td>{{ $item->invoice_no }}</td>
                                            <td> <span
                                                    style="color: {{ $item->payment_type === 'အကြွေး' ? 'red' : ($item->payment_type === 'Moblie Payment' ? 'green' : '') }}">
                                                    {{ $item->payment_type }}
                                            <td>{{ $item->sub_total }}</td>
                                            <td>{{ $item->accepted_ammount }}</td>
                                            <td>{{ $item->return_change }}</td>
                                            <td>
                                                <a href="{{ route('detail#sale', $item->id) }}"
                                                    class="btn btn-info sm" title="Detail Data"><i
                                                        class="far fa-eye"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection
