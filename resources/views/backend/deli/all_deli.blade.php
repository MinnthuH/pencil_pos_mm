@extends('admin_dashboard')


@section('admin')
@section('title')
    All Deli | Pencil POS System
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
                            <a href="{{ route('add.deli') }}"
                                class="btn btn-blue rounded-pill waves-effect waves-light">Deli အသစ်ထည့်ရန်</a>
                        </ol>
                    </div>
                    <h4 class="page-title">Deli စာရင်းများ</h4>
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
                                    <th>အမည်</th>
                                    <th>ဖုန်းနံပါတ်</th>
                                    <th>လိပ်စာ</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($delis as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            @if (Auth::user()->can('admin.manage'))
                                                <a href="{{ route('edit.deli', $item->id) }}" class="btn btn-info sm"
                                                    title="Edit Data"><i class="far fa-edit"></i></a>
                                            @endif
                                            @if (Auth::user()->can('admin.manage'))
                                                <a href="{{ route('delete.deli', $item->id) }}"
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
