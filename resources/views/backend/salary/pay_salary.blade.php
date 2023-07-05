@extends('admin_dashboard')


@section('admin')
@section('title')
    All Pay Salary | Pencil POS System
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
                            <a href="{{ route('add#advSalary') }}"
                                class="btn btn-blue rounded-pill waves-effect waves-light">Add Pay Salary</a>
                        </ol>
                    </div>
                    <h4 class="page-title">All Pay Salary Tables</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ date(' F Y ') }}</h4>
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Salary</th>
                                    <th>Advance</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($employee as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->image) }}" style="width:50px;height:40px;"
                                                alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td><span class="badge bg-info">{{ date('F', strtotime('-1 month')) }}</span>
                                        </td>
                                        <td>{{ $item->salary }}</td>
                                        <td>
                                            @if (empty($item['advance']['advance_salary']))
                                                <p>No Advance</p>
                                            @else
                                                {{ $item['advance']['advance_salary'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $advance_salary = $item['advance']['advance_salary'] ?? 0;
                                                $amount = $item->salary - $advance_salary;
                                            @endphp
                                            <strong >{{ $amount }}</strong>
                                        </td>

                                        <td>
                                            <a href="{{ route('pay#Now', $item->id) }}"
                                                class="btn btn-outline-blue rounded-pill waves-effect waves-light"
                                                title="Pay Now">Pay Now</a>
                                        </td>
                                        <td>

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
