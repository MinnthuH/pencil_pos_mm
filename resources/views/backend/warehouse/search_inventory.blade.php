@extends('admin_dashboard')


@section('admin')
@section('title')
    All Inevntory | Pencil POS System
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
                            @if (Auth::user()->can('admin.manage'))
                                <a href="{{ route('import#product') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light"> Import</a>
                                &nbsp;
                                <a href="{{ route('export#product') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light"> Export</a>
                                &nbsp;
                            @endif
                            <a href="{{ route('add#product') }}"
                                class="btn btn-blue rounded-pill waves-effect waves-light">စတိုကုန်ပစ္စည်း အသစ်ထည့်ရန်</a>
                        </ol>
                    </div> --}}
                    <h4 class="page-title">ကုန်ပစ္စည်းစာရင်းများ </h4>
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
                                    <th>အမည်</th>
                                    <th>အမျိုးအစား</th>
                                    <th>ကုန်ပစ္စည်း ကုဒ်</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($product as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->product_image) }}" style="width:50px;height:40px;"
                                                alt=""></td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item['category']['category_name'] }}</td>
                                        <td>{{ $item->product_code }}</td>
                                        <td>

                                            @if (Auth::user()->can('product.edit'))
                                                <a href="{{ route('add.inventory', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Data"><i
                                                        class="fas fa-plus"></i></a>
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
