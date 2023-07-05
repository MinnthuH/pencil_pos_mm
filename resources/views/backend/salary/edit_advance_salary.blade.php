@extends('admin_dashboard')

@section('admin')
@section('title')
    Edit AdvSalary | Pencil POS System
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
                    <h4 class="page-title">Edit Advance Salary</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('update#advsalary') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{$advSalary->id}}">
                                <h5 class="mb-4 text-uppercase"><i class="fas fa-money-bill-wave me-1"></i> Edit Advance
                                    Salary
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Employee Name</label>
                                            <select name="employeeId" class="form-select" id="example-select">
                                                <option selected disabled>Select Employee</option>
                                                @foreach ($employee as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $advSalary->employee_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="month" class="form-label">Salary Month</label>
                                            <select name="month"
                                                class="form-select @error('month') is-invalid
                                            @enderror"
                                                id="example-select">
                                                <option selected disabled>Select Month</option>
                                                <option
                                                    value="January"{{ $advSalary->month == 'January' ? 'selected' : '' }}>
                                                    January</option>
                                                <option
                                                    value="Febuary"{{ $advSalary->month == 'Febuary' ? 'selected' : '' }}>
                                                    Febuary</option>
                                                <option
                                                    value="March"{{ $advSalary->month == 'March' ? 'selected' : '' }}>
                                                    March</option>
                                                <option
                                                    value="April"{{ $advSalary->month == 'April' ? 'selected' : '' }}>
                                                    April</option>
                                                <option
                                                    value="May"{{ $advSalary->month == 'May' ? 'selected' : '' }}>May
                                                </option>
                                                <option
                                                    value="Jun"{{ $advSalary->month == 'Jun' ? 'selected' : '' }}>Jun
                                                </option>
                                                <option
                                                    value="July"{{ $advSalary->month == 'July' ? 'selected' : '' }}>
                                                    July</option>
                                                <option
                                                    value="August"{{ $advSalary->month == 'August' ? 'selected' : '' }}>
                                                    August</option>
                                                <option
                                                    value="September"{{ $advSalary->month == 'September' ? 'selected' : '' }}>
                                                    September</option>
                                                <option
                                                    value="October"{{ $advSalary->month == 'October' ? 'selected' : '' }}>
                                                    October</option>
                                                <option
                                                    value="November"{{ $advSalary->month == 'November' ? 'selected' : '' }}>
                                                    November</option>
                                                <option
                                                    value="December"{{ $advSalary->month == 'December' ? 'selected' : '' }}>
                                                    December</option>
                                            </select>
                                            @error('month')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="slary-year" class="form-label">Salary Year</label>
                                            <select name="year"
                                                class="form-select @error('year') is-invalid
                                            @enderror"
                                                id="example-select">
                                                <option selected disabled>Select Year</option>
                                                <option
                                                    value="2022"{{ $advSalary->year == '2022' ? 'selected' : '' }}>
                                                    2022</option>
                                                <option
                                                    value="2023"{{ $advSalary->year == '2023' ? 'selected' : '' }}>
                                                    2023</option>
                                                <option
                                                    value="2024"{{ $advSalary->year == '2024' ? 'selected' : '' }}>
                                                    2024</option>
                                                <option
                                                    value="2025"{{ $advSalary->year == '2025' ? 'selected' : '' }}>
                                                    2025</option>
                                                <option
                                                    value="2026"{{ $advSalary->year == '2026' ? 'selected' : '' }}>
                                                    2026</option>
                                            </select>
                                            @error('year')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Advance Salary</label>
                                            <input type="text" name="advSalary"
                                                class="form-control @error('advSalary') is-invalid
                                            @enderror"
                                                value="{{ $advSalary->advance_salary }}">
                                            @error('advSalary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div> <!-- end row -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Upate</button>
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
