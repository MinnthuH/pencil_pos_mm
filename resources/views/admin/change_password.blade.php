@extends('admin_dashboard')

@section('admin')
@section('title')
    Change Password | Pencil POS System
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
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Change Passwod</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Change Password</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">


                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('update#password') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="oldPassowrd" class="form-label">Old Password</label>
                                            <input type="password" name="oldPassword"
                                                class="form-control @error('oldPassword') is-invalid
                                            @enderror"
                                                id="current_password">
                                            @error('oldPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">New Password</label>
                                            <input type="password" name="newPassword"
                                                class="form-control @error('newPassword') is-invalid
                                            @enderror"
                                                id="new_password">
                                            @error('newPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="confirmPassowrd" class="form-label">Confirm New Password</label>
                                            <input type="password" name="confirmPassowrd" class="form-control "
                                                id="confirm_Passowrd">
                                        </div>
                                    </div>


                                </div> <!-- end row -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
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
