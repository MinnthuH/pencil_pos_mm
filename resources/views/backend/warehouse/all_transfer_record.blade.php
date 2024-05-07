@extends('admin_dashboard')


@section('admin')
@section('title')
    Transfer Record | Pencil POS System
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
                            @if (Auth::user()->can('warhouse.add'))
                                <a href="{{ route('search.inventory') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light">စတို ကုန်ပစ္စည်း
                                    အသစ်ထည့်ရန်</a>
                            @endif
                        </ol>
                    </div>
                    <h4 class="page-title">စတို ကုန်ပစ္စည်း လွှဲေြာင်းမှု စာရင်းများ </h4>
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
                                    <th>ဓါတ်ပုံ</th>
                                    <th>ကုန်ပစ္စည်း အမည်</th>
                                    <th>Transfer Date</th>
                                    <th>Transfer Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($transfer as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td><img src="{{ asset($item->product->product_image ?: 'upload/no_image.jpg') }}"
                                                style="width:50px;height:40px;" alt=""></td>
                                        <td>{{ $item['product']['product_name'] }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->quantity }}</td>

                                        <td>
                                            {{-- @if (Auth::user()->can('warehouse.edit'))
                                                <a href="{{ route('edit.inventory', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Inventory"><i
                                                        class="far fa-edit"></i></a>
                                            @endif --}}
                                            @if (Auth::user()->can('warehouse.delete'))
                                                <a href="{{ route('delete.transfer.record', $item->id) }}"
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
