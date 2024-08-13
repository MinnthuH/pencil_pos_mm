@extends('admin_dashboard')


@section('admin')
@section('title')
   All Stock In | Pencil POS System
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
                            @if (Auth::user()->can('admin.manage'))
                                <a href="{{ route('export.daily.stockin') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light">Export Daily</a>
                                &nbsp;
                                <a href="{{ route('export.weekly.stockin') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light">Export Weekly</a>
                                &nbsp;
                            @endif
                        </ol>
                    </div>
                    <h4 class="page-title"> All Stock In list  </h4>
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
                                    <th>Invoice No</th>
                                    <th>Shop Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($stockIn as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->invoice_no }}</td>
                                        <td>{{ $item->shop->name }}</td>
                                        <td>{{ $item->date }}</td> <!-- Display the formatted date -->

                                        <td>
                                            {{-- @if (Auth::user()->can('warehouse.edit'))
                                                <a href="{{ route('edit.inventory', $item->id) }}" class="btn btn-info sm" title="Edit Inventory"><i class="far fa-edit"></i></a>
                                            @endif --}}

                                            <a href="{{route('detail.stockin',$item->invoice_no)}}"
                                                class="btn btn-info sm" title="Detail"><i
                                                    class="fas fa-eye"></i></a>

                                                {{-- <a href="{{ route('delete.stockin', $item->id) }}"
                                                    class="btn btn-danger sm" title="Delete Data" id="delete"><i
                                                        class="fas fa-trash-alt"></i></a> --}}

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
