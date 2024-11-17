@extends('admin_dashboard')


@section('admin')
@section('title')
    All Control Record List | Pencil POS System
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
                            <a href="{{ route('add#shop') }}"
                                class="btn btn-blue rounded-pill waves-effect waves-light">Add Shop</a>
                        </ol>
                    </div> --}}
                    <h4 class="page-title">All Control Record</h4>
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
                                    <th>Job No</th>
                                    <th>Date</th>
                                    <th>အမည်</th>
                                    <th>ဆိုင်အမည်</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($controlRecords as $key => $record)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $record->date }}</td>
                                        <td>{{ $record->job_number }}</td>
                                        <td>{{ $record->user->name ?? 'N/A' }}</td>
                                        <td>{{ $record->shop->name ?? 'N/A' }}</td>
                                        <td>{{ $record->action }}</td>
                                        <td>{{ $record->description }}</td>
                                        <td>

                                            <a href="{{ route('detail.record', $record->job_number) }}"
                                                class="btn btn-primary sm" title="Delete Data" id="Detail"><i
                                                    class="fas fa-eye"></i></a>

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
