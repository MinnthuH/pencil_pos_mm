@extends('admin_dashboard')

@section('admin')
@section('title')
    Detail Record | Pencil POS System
@endsection
<div class="content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Detail Record of Job Number: {{ $numberOfRecords }}</h4>
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
                                    <th>User Name</th>
                                    <th>Shop Name</th>
                                    <th>Date</th>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailRecords as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                                        <td>{{ $item->shop->name ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                        <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                                        <td>{{ $item->action }}</td>
                                        <td>{{ $item->description }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
