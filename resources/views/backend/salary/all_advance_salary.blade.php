@extends('admin_dashboard')


@section('admin')
@section('title')
All AdvSalary | Pencil POS System
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
                            <a href="{{ route('add#advSalary')}}" class="btn btn-blue rounded-pill waves-effect waves-light">Add Advance Salary</a>
                        </ol>
                    </div>
                    <h4 class="page-title">All Advance Salary Tables</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Salary</th>
                                    <th>Advance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                               @foreach ( $salary as $key => $item)
                               <tr>
                                <td>{{$key+1}}</td>
                                <td><img src="{{asset($item->employee->image)}}" style="width:50px;height:40px;" alt=""></td>
                                <td>{{$item['employee']['name']}}</td>
                                <td>{{$item->month}}</td>
                                <td>{{$item['employee']['salary']}}</td>
                                <td>{{$item->advance_salary}}</td>
                                <td>
                                    <a href="{{ route('edit#advSalary',$item->id)}}" class="btn btn-info sm"
                                        title="Edit Data"><i class="far fa-edit"></i></a>

                                    <a href="{{ route('delete#advSalary',$item->id)}}"
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

@endsection
