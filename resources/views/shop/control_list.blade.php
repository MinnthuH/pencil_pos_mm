@extends('admin_dashboard')


@section('admin')
@section('title')
    All Control History List | Pencil POS System
@endsection
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    {{-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('add#shop') }}"
                                class="btn btn-blue rounded-pill waves-effect waves-light">Add Shop</a>
                        </ol>
                    </div> --}}
                    <h4 class="page-title">All Control History List</h4>
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
                                    <th>No</th>
                                    <th>အမည်</th>
                                    <th>ဆိုင်အမည်</th>
                                    <th>ကုန်ပစ္စည်းအမည်</th>
                                    <th>အကြောင်းအရာ</th>
                                    <th>အရေအတွက်</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($controlList as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->shop->name }}</td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->action }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>

                                            <a href="{{ route('control.list.delete', $item->id) }}"
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
