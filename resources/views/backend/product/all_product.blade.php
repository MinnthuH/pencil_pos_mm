@extends('admin_dashboard')


@section('admin')
@section('title')
    All Product | Pencil POS System
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
                            <a href="{{ route('import#product')}}" class="btn btn-blue rounded-pill waves-effect waves-light"> Import</a>
                            &nbsp;
                            <a href="{{ route('export#product')}}" class="btn btn-blue rounded-pill waves-effect waves-light"> Export</a>
                            &nbsp;
                            <a href="{{ route('add#product')}}" class="btn btn-blue rounded-pill waves-effect waves-light">ကုန်ပစ္စည်း အသစ်ထည့်ရန်</a>
                        </ol>
                    </div>
                    <h4 class="page-title">ကုန်ပစ္စည်းစာရင်းများ</h4>
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
                                    <th>အမည်</th>
                                    <th>အမျိုးအစား</th>
                                    <th>တင်သွင်းသူ</th>
                                    <th>ကုန်ပစ္စည်း ကုဒ်</th>
                                    <th>ဈေးနှုန်း</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                               @foreach ($product as $key => $item)
                               <tr>
                                <td>{{$key+1}}</td>
                                <td><img src="{{asset($item->product_image)}}" style="width:50px;height:40px;" alt=""></td>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item['category']['category_name']}}</td>
                                <td>{{$item['supplier']['name']}}</td>
                                <td>{{$item->porduct_code}}</td>
                                <td>{{$item->selling_price}}</td>
                                <td>
                                    @if ($item->expire_date >= Carbon\Carbon::now()->format('Y-m-d'))
                                    <span class="badge rounded-pill bg-success">Valid</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Invalid</span>
                                    @endif

                                </td>
                                <td>
                                    <a href="{{ route('code#product',$item->id)}}" class="btn btn-warning sm"
                                        title="barcode"><i class="fas fa-barcode"></i></a>

                                    <a href="{{ route('edit#product',$item->id)}}" class="btn btn-info sm"
                                        title="Edit Data"><i class="far fa-edit"></i></a>

                                    <a href="{{ route('delete#porduct',$item->id)}}"
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
