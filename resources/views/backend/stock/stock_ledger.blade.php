@extends('admin_dashboard')


@section('admin')
@section('title')
    Stock Ledger | Pencil POS System
@endsection
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    {{-- <div class="page-title-right">
                        @if (Auth::user()->can('admin.manage'))
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('sales.export.daily', $id) }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light ">Export Daily Sales</a>
                                <span class="ms-2"></span><span></span>
                                <a href="{{ route('sales.export.weekly', $id) }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light">Export Weekly Sales</a>
                                <span class="ms-2"></span><span></span>
                                <a href="{{ route('sales.export.monthly', $id) }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light">Export Monthly Sales</a>
                            </ol>
                        @endif
                    </div> --}}
                    <h4 class="page-title">Stock Ledger</h4>

                    {{-- @if ($startDate && $endDate)
                        @if ($startDate == $endDate)
                            (<span>Date: {{ \Carbon\Carbon::parse($startDate)->format('m/d/Y') }}</span>)
                        @else
                            (<span>Date: {{ \Carbon\Carbon::parse($startDate)->format('m/d/Y') }} -
                                {{ \Carbon\Carbon::parse($endDate)->format('m/d/Y') }}</span>)
                        @endif
                    @else
                        (<span>Date: {{ \Carbon\Carbon::now()->format('m/d/Y') }}</span>)
                    @endif

 --}}

                    </h4>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{ route('stock.ledger') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-2">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>

                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">Shop</label>
                        <select class="form-control select2" name="shop_id">
                            <option>Select Shop</option>
                            <optgroup label="Shops">
                                @foreach ($shops as $shop)
                                    <option value="{{ $shop->id }}"
                                        {{ request('shop_id') == $shop->id ? 'selected' : '' }}>
                                        {{ $shop->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">Prouduct</label>
                        <select class="form-control select2" name="product_id">
                            <option>Select Product</option>
                            <optgroup label="Products">
                                @foreach ($products as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('product_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->product_name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 mt-3">
                    <button type="submit" class="btn"
                        style="background-color: #4A81D4; color: white">Search</button>
                </div>
            </div>
        </form>

        @if (request('start_date') || request('end_date') || request('shop_id') || request('product_id'))
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Shop Name</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>In</th>
                                        <th>Out</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($grouped_data->isNotEmpty())
                                        @php $current_balance = floatval($opening_balance); @endphp
                                        @foreach ($grouped_data as $data)
                                            @php
                                                $quantity_in = floatval($data['quantity_in'] ?? 0); // Ensure it's a number
$quantity_out = floatval($data['quantity_out'] ?? 0); // Ensure it's a number
                                                $current_balance += $quantity_in - $quantity_out;
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <!-- Use loop iteration for row numbering -->
                                                <td>{{ $data['date'] }}</td>
                                                <td>{{ $data['shop_name'] }}</td>
                                                <td>{{ $data['product_name'] }}</td>
                                                @php
                                                    $productCodes = json_decode($data['product_code']);
                                                @endphp
                                                @if (is_array($productCodes))
                                                    <td>

                                                        @foreach ($productCodes as $code)
                                                            {{ $code }} ,
                                                        @endforeach

                                                    </td>
                                                @else
                                                    <td>
                                                        {{ $data['product_code'] }}
                                                    </td>
                                                @endif
                                                <td>{{ $quantity_in }}</td>
                                                <td>{{ $quantity_out }}</td>
                                                <td>{{ $current_balance }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No data available for the selected
                                                filters.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        @else
            <div class="alert alert-info text-center">
                Please use the search form to filter and display the data.
            </div>
        @endif
        <!-- end row-->
    </div> <!-- container -->

</div> <!-- content -->

@endsection
