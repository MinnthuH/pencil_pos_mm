@extends('admin_dashboard')


@section('admin')
@section('title')
    All Category | Pencil POS System
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
                            <button type="button" class="btn btn-blue" data-bs-toggle="modal"
                                data-bs-target="#signup-modal">အမျိုးအစား အသစ်ထည့်ရန်</button>
                        </ol>
                    </div>
                    <h4 class="page-title">အမျိုးအစား စာရင်းများ</h4>
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
                                    <th>အမျိုးအစား အမည်</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($allCategory as $key => $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>
                                            @if (Auth::user()->can('admin.manage'))
                                                <a href="{{ route('edit#category', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Data"><i
                                                        class="far fa-edit"></i></a>

                                                <a href="{{ route('delete#category', $item->id) }}"
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
