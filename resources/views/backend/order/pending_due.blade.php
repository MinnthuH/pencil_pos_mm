@extends('admin_dashboard')


@section('admin')
@section('title')
    Pending Due | Pencil POS System
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
                    <h4 class="page-title">Pending Order</h4>
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
                                    <th>Name</th>
                                    <th>Order Date</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                    <th>Pay</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($alldue as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['customer']['name'] }}</td>
                                        <td>{{ $item->order_date }}</td>
                                        <td>{{ $item->paymet_status }}</td>
                                        <td> <span class="btn btn-info waves-effect wave">{{ $item->total }}
                                            Ks</span></td>
                                        <td> <span class="btn btn-warning waves-effect wave">{{ $item->pay }}
                                                Ks</span></td>
                                        <td> <span class="btn btn-danger waves-effect wave">{{ $item->due }}
                                                Ks</span></td>

                                        <td>
                                            <button type="button" class="btn btn-blue" data-bs-toggle="modal"
                                                data-bs-target="#signup-modal" id="{{ $item->id }}"
                                                onclick="orderDue(this.id)">Pay Due</button>
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
<!-- Signup modal content -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <div class="text-center mt-2 mb-4">
                    <div class="auth-logo">
                        <h3>Pay Due Amonunt</h3>
                    </div>
                </div>


                <form class="px-3" action="{{ route('update#due') }}" method="post">
                    @csrf

                    <input type="hidden" name="id" id="orderid">
                    <input type="hidden" name="pay" id="pay">

                    <div class="mb-3">
                        <label for="paydue" class="form-label">Pay Due</label>
                        <input class="form-control" type="text"  name="due" id="due">
                    </div>


                    <div class="mb-3 text-center">
                        <button class="btn btn-blue" type="submit">Update Due</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function orderDue(id) {

        $.ajax({
            type: 'GET',
            url: '/order/due/' + id,
            dataType: 'json',
            success: function(data) {
                $('#due').val(data.due);
                $('#pay').val(data.pay);
                $('#orderid').val(data.id);
            }
        })
    }
</script>


@endsection
