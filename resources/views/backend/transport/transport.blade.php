@extends('admin_dashboard')


@section('admin')
@section('title')
    Transport | Pencil POS System
@endsection
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Transport Detail </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 style="font-size:30px;" align="center">Total :{{ count($product) }} Pcs</h4> --}}
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>စဉ်</th>
                                    <th>Date</th>
                                    <th>Invoice No</th>
                                    <th>staff_amount</th>
                                    <th>owner_amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($transports as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->sale->invoice_no }}</td>
                                        <td>{{ $item->staff_amount }}</td>
                                        <td>{{ $item->owner_amount }}</td>

                                        <td>

                                            <a href="{{ route('delete.detail', $item->id) }}" class="btn btn-danger sm"
                                                title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>

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
