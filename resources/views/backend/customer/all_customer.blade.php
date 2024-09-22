@extends('admin_dashboard')


@section('admin')
@section('title')
    All Customer | Pencil POS System
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
                            @if (Auth::user()->can('customer.add'))
                                <a href="{{ route('add#customer') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light">ဖေါက်သည် အသစ်ထည့်ရန်</a>
                            @endif
                        </ol>
                    </div>
                    <h4 class="page-title">ဖေါက်သည် စာရင်း</h4>
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
                                    <th>ဖုန်းနံပါတ်</th>
                                    <th>ဆိုင်နာမည်</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($allCustomer as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->image ?: 'upload/no_image.jpg') }}"
                                                style="width:50px;height:40px;" alt=""></td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->shopname }}</td>
                                        <td>
                                            @if (Auth::user()->can('customer.edit'))
                                                <a href="{{ route('edit#customer', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Data"><i
                                                        class="far fa-edit"></i></a>
                                            @endif
                                            @if (Auth::user()->can('customer.delete'))
                                                <a href="{{ route('delete#customer', $item->id) }}"
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
