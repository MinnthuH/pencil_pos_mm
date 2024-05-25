@extends('admin_dashboard')


@section('admin')
@section('title')
    All Refurn | Pencil POS System
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
                            {{-- @if (Auth::user()->can('admin.manage'))
                                <a href="{{ route('import#product') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light"> Import</a>
                                &nbsp;
                                <a href="{{ route('export#product') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light"> Export</a>
                                &nbsp;
                            @endif --}}
                            {{-- <a href="{{ route('add#product') }}"
                                class="btn btn-blue rounded-pill waves-effect waves-light">Add Refurn</a> --}}
                        </ol>
                    </div>
                    <h4 class="page-title">All Refurn </h4>
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
                                    <th>စဉ်</th>
                                    <th>Date</th>
                                    <th>Invoice No</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Refurn Amout</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($refurnAll as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item['sale']['invoice_no'] }}</td>
                                        <td>{{ $item['saleitem']['product']['product_name'] }}</td>
                                        <td>{{ $item->refurnqty }}</td>
                                        <td>{{ $item->refurn_amout }}</td>

                                        {{-- <td>
                                            <a href="{{ route('code#product', $item->id) }}" class="btn btn-warning sm"
                                                title="barcode"><i class="fas fa-barcode"></i></a>
                                            @if (Auth::user()->can('product.edit'))
                                                <a href="{{ route('edit#product', $item->id) }}" class="btn btn-info sm"
                                                    title="Edit Data"><i class="far fa-edit"></i></a>
                                            @endif
                                            @if (Auth::user()->can('product.delete'))
                                                <a href="{{ route('delete#porduct', $item->id) }}"
                                                    class="btn btn-danger sm" title="Delete Data" id="delete"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            @endif
                                        </td> --}}
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
