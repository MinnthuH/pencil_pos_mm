@extends('admin_dashboard')


@section('admin')
@section('title')
    Stock Control Order | Pencil POS System
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
                            <a href="{{ url('/all/shop') }}" class="btn btn-blue  waves-effect waves-light ">Cancel</a>
                            <span class="ms-2"></span><span></span>
                            <form action="{{ route('add.control') }}" method="post">
                                @csrf
                                {{-- <input type="hidden" name="shopId" value="{{ $shop->id }}"> --}}
                                <input type="hidden" name="shopId" value="{{ $shop->id }}">
                                <input type="hidden" name="action" value="{{ $action }}">
                                <input type="hidden" name="description" value="{{ $description }}">
                                <button class="btn btn-blue waves-effect waves-light " type="submit">Comfirm</button>
                            </form>

                            <span class="ms-2"></span><span></span>
                        </ol>


                    </div>
                    <h4 class="page-title">{{ $shop->name ?? 'Unknown' }} &nbsp; Stock Control </h4>
                </div>
                @php
                    $totalItems = count($cartItem); // Count the total number of items
                @endphp
                <h4>Total Prodcuts: {{ $totalItems }}</h4>
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
                                    <th class="text-wrap">ကုန်ပစ္စည်းအမည်</th>
                                    <th>အရေအတွက်</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($cartItem as $key => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <!-- Use $loop->iteration to get the current iteration number -->
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $action }}</td>
                                        <td>{{ $description }}</td>

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
