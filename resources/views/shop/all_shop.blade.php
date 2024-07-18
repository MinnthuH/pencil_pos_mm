@extends('admin_dashboard')


@section('admin')
@section('title')
    All Shops | Pencil POS System
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
                            <a href="{{ route('add#shop') }}"
                                class="btn btn-blue rounded-pill waves-effect waves-light">Add Shop</a>
                        </ol>
                    </div>
                    <h4 class="page-title">All Shops List</h4>
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
                                    <th>Shop Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($shops as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>

                                            <a href="{{ route('shop.stock', $item->id) }}"
                                                class="btn btn-primary sm" title="Shop Stock"><i
                                                    class="fas fa-chart-line"></i></a>

                                                <a href="{{ route('shop#info', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Data"><i
                                                        class="far fa-edit"></i></a>

                                                <a href="{{ route('shop#delete', $item->id) }}"
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


<!-- Signup modal content -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <form class="px-3" action="{{ route('store#category') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">အမျိုးအစားအမည်</label>
                        <input class="form-control" type="text" id="naem" name="categoryName"
                            placeholder="အမျိုးအစား အမည် ထည့်ပါ">
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-blue" type="submit">Add</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
