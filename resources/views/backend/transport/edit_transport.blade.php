@extends('admin_dashboard')

@section('admin')
@section('title')
    Edit Transport | Pencil POS System
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
                    <h4 class="page-title">Edit Transport</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('update.transport') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $transport->id }}">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add
                                    Transport
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Transport Type</label>
                                            <input type="text" name="transport_type" class="form-control"
                                                value="{{ $transport->transport_type }}">
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Transport Amount</label>
                                            <input type="number" name="transport_chagre" class="form-control"
                                                value="{{ $transport->transport_chagre }}">
                                        </div>
                                    </div>
                                    <!-- end col -->


                                    <div class="text-end">
                                        <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Update</button>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                transport_type: {
                    required: true,
                },
                transport_chagre: {
                    required: true,
                }

            },
            messages: {
                transport_type: {
                    required: 'Please Fill Transport Type',
                },
                transport_chagre: {
                    required: 'Please Fill Transport Amount',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>




@endsection
