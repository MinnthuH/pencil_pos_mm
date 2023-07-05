@extends('admin_dashboard')


@section('admin')
@section('title')
    Attend List | Pencil POS System
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
                            <a href="{{ route('add#customer') }}"
                                class="btn btn-blue rounded-pill waves-effect waves-light">Add Employee Attendence</a>
                        </ol>
                    </div>
                    <h4 class="page-title">All Attendence List</h4>
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
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($allAttendanceList as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ date('Y-m-d', strtotime($item->date)) }}</td>
                                        <td>
                                            <a href="{{ route('edit#employeeAttend',$item->date)}}" class="btn btn-info sm"
                                                title="Edit Data">Edit</a>

                                            <a href="{{ route('view#employeeAttend',$item->date)}}"
                                                class="btn btn-danger sm" title="Delete Data" id="view">View</a>
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
