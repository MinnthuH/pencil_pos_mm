@extends('admin_dashboard')

@section('admin')
@section('title')
    Paid Salary | Pencil POS System
@endsection


<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Paid Salary</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('paid#Salary') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $paySalary->id}}">
                                <h5 class="mb-4 text-uppercase"><i class="fas fa-money-bill-wave me-1"></i> Paid Salary
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Employee Name</label>
                                            <strong class="ms-3">{{ $paySalary->name }}</strong>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="month" class="form-label">Salary Month</label>
                                            <strong class="ms-3">{{ date('F', strtotime('-1 month')) }}</strong>
                                            <input type="hidden" name="month" value="{{ date('F', strtotime('-1 month')) }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="slary-year" class="form-label">Employee Salary</label>
                                            <strong class="ms-3">{{ $paySalary->salary }}</strong>
                                            <input type="hidden" name="salary" value="{{ $paySalary->salary }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    @php
                                        $advance_salary = $paySalary['advance']['advance_salary'] ?? 0;
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="slary-year" class="form-label">Advance Salary</label>
                                            <strong class="text-danger ms-3">{{ $advance_salary }}</strong>
                                            <input type="hidden" name="advSalary" value="{{ $advance_salary }}">

                                        </div>
                                    </div>
                                    <!-- end col -->
                                    @php
                                        $advance_salary = $paySalary['advance']['advance_salary'] ?? 0;
                                        $amount = $paySalary->salary - $advance_salary;
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="slary-year" class="form-label">Due Salary</label>
                                            <strong class="ms-3">{{ $amount }}</strong>
                                            <input type="hidden" name="dueSalary" value="{{ $amount }}">

                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div> <!-- end row -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Paid Salary</button>
                                </div>
                            </form>
                        </div>
                        <!-- end settings content-->

                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
