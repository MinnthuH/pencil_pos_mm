@extends('admin_dashboard')


@section('admin')
@section('title')
Month Salary | Pencil POS System
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
                            <a href="{{route('pay#Salary')}}" class="btn btn-blue rounded-pill waves-effect waves-light">Pay Salary</a>
                        </ol>
                    </div>
                    <h4 class="page-title">Latest Month Salary</h4>
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Salary</th>
                                    <th>Stauts</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                               @foreach ( $paidSalary as $key => $item)
                               <tr>
                                <td>{{$key+1}}</td>
                                <td><img src="{{asset($item->employee->image)}}" style="width:50px;height:40px;" alt=""></td>
                                <td>{{$item['employee']['name']}}</td>
                                <td>{{$item->salary_month}}</td>
                                <td>{{$item['employee']['salary']}}</td>
                                <td><span class="badge bg-success">Full Paid</span></td>
                                <td>
                                    <a href="{{ route('pay#Now',$item->id)}}" class="btn btn-info sm"
                                        title="History"><i class="far fa-edit"></i></a>

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
