@extends('admin_dashboard')


@section('admin')
@section('title')
    All Supplier | Pencil POS System
@endsection
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        @if (Auth::user()->can('supplier.add'))
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('add#supplier') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light">တင်သွင်းသူ အသစ်ထည့်ရန်</a>
                            </ol>
                        @endif
                    </div>
                    <h4 class="page-title">တင်သွင်းသူ စာရင်း</h4>
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
                                    <th>ဓါတ်ပုံ</th>
                                    <th>အီးမေးလ်</th>
                                    <th>ဖုန်း</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($allSupplier as $key => $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><img src="{{ asset($item->image ?: 'upload/no_image.jpg') }}"
                                                style="width:50px;height:40px;" alt=""></td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>
                                            @if (Auth::user()->can('supplier.edit'))
                                                <a href="{{ route('detail#supplier', $item->id) }}"
                                                    class="btn btn-warning sm" title="Detail Data"><i
                                                        class="fas fa-info-circle"></i></a>
                                            @endif

                                            @if (Auth::user()->can('supplier.edit'))
                                                <a href="{{ route('edit#supplier', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Data"><i
                                                        class="far fa-edit"></i></a>
                                            @endif

                                            @if (Auth::user()->can('supplier.delete'))
                                                <a href="{{ route('delete#supplier', $item->id) }}"
                                                    class="btn btn-danger sm" title="Delete Data" id="delete"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            @endif
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
