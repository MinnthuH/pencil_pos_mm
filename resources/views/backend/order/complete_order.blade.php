@extends('admin_dashboard')


@section('admin')
@section('title')
    Complete Order | Pencil POS System
@endsection
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                        </ol>
                    </div>
                    <h4 class="page-title">Complete Order</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Order Date</th>
                                    <th>Payment</th>
                                    <th>Invoice</th>
                                    <th>Pay</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($order as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['customer']['name'] }}</td>
                                        <td>{{ $item->order_date }}</td>
                                        <td>{{ $item->paymet_status }}</td>
                                        <td>{{ $item->invoice_no }}</td>
                                        <td>{{ $item->pay }}</td>

                                        <td><span class="badge bg-info">{{ $item->order_status }}</span></td>
                                        <td>
                                            <a href="{{ url('order/invoice-download', $item->id) }}" class="btn btn-blue"
                                                title="Edit Data">PDF Invoice</a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->


    </div> <!-- container -->

</div> <!-- content -->

@endsection
