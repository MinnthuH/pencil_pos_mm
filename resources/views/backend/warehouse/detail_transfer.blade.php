@extends('admin_dashboard')

@section('admin')
@section('title')
    Detail Transfer | Pencil POS System
@endsection

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mb-2">
                    <h4 class="page-title">
                        {{ $transfer->first()->fromshop->name ?? 'N/A' }} <span>မှ</span> {{ $transfer->first()->toshop->name ?? 'N/A' }} <span></span>သို့ ကုန်ပစ္စည်းအဝင်စာရင်း
                    </h4>
                    <h4 class="page-title ms-5">Total Transfer Products: {{ $transferProducts }}</h4>
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
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transfer as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                                        <td>{{ $item->total_quantity }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                        <td>
                                            @if (Auth::user()->can('warehouse.delete'))
                                            <form action="{{ route('delete.transfer.record') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="fromshopid" value="{{ $item->from_shop_id }}">
                                                <input type="hidden" name="toshopid" value="{{ $item->to_shop_id }}">
                                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                <input type="hidden" name="date" value="{{ $item->date }}">
                                                <button type="submit" class="btn btn-danger sm" title="Delete Data">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
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
