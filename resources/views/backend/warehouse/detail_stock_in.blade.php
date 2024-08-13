@extends('admin_dashboard')


@section('admin')
@section('title')
    Detail Stock In | Pencil POS System
@endsection
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-2">
                    <h4 class="page-title">{{ $shopName }}<span></span> သို့ ကုန်ပစ္စည်းအဝင်စာရင်း</h4>

                    <h4 class="page-title ms-5">Total Prodcuts: {{ $productCount }}</h4>

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
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($stockInDetails as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('delete.stockin', $item->id) }}"
                                                class="btn btn-danger sm" title="Delete Data" id="delete"><i
                                                    class="fas fa-trash-alt"></i></a>
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
