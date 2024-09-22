@extends('admin_dashboard')


@section('admin')
@section('title')
    TrashSales | Pencil POS System
@endsection
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">အရောင်းစာရင်း</h4>
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
                                    <th class="text-wrap">အရောင်းတာဝန်ခံ</th>
                                    <th>ဆိုင်အမည်</th>
                                    <th>ဘောင်ချာ နေစွဲ</th>
                                    <th>ဘောင်ချာနံပါတ်</th>
                                    <th>ငွေပေးချေမှု ပုံစံ</th>
                                    <th>ကျသင့်ငွေ</th>
                                    <th>ပေးငွေ</th>
                                    <th>ပြန်အမ်းငွေ</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($sales as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['user']['name'] }}</td>
                                        <td>{{ $item->shop->name }}</td>
                                        <td>{{ $item->invoice_date }}</td>
                                        <td>{{ $item->invoice_no }}</td>
                                        <td> <span
                                                style="color: {{ $item->payment_type === 'အကြွေး' ? 'red' : ($item->payment_type === 'Moblie Payment' ? 'green' : '') }}">
                                                {{ $item->payment_type }}
                                            </span></td>
                                        <td class="text-end">{{ number_format($item->sub_total) }}</td>
                                        <td class="text-end">{{ number_format($item->accepted_ammount) }}</td>
                                        <td class="text-end">{{ number_format($item->return_change) }}</td>
                                        <td>
                                            @if (Auth::user()->can('admin.manage'))
                                                <a href="{{ route('force.delete.sale', $item->id) }}"
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
