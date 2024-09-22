@extends('admin_dashboard')

@section('admin')
@section('title')
    Add Expense | Pencil POS System
@endsection
{{-- jquery link  --}}
<script src="{{ asset('backend/assets/jquery.js') }}"></script>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">Add Expense</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('stroe#expense') }}">
                                @csrf

                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Expense
                                </h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="detail" class="form-label">Expense Detail</label>
                                            <textarea class="form-control" name="deatil" id="example-textarea" rows="3"></textarea>

                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <input type="text" name="amount"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label"></label>
                                            <input type="hidden" name="date"
                                                class="form-control" value="{{ date('d-m-Y')}}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label"></label>
                                            <input type="hidden" name="month"
                                                class="form-control" value="{{ date('F')}}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label"></label>
                                            <input type="hidden" name="year"
                                                class="form-control"value="{{ date('Y')}}">
                                        </div>
                                    </div>
                                    <!-- end col -->


                                </div> <!-- end row -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Save</button>
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





@endsection
