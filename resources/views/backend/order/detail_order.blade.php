@extends('admin_dashboard')

@section('admin')
@section('title')
    Detail Order | Pencil POS System
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
                    <h4 class="page-title">Order Detail</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('update#status') }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{$order->id}}">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Order Detail
                                </h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <img id="showImage" src="{{asset($order->customer->image)}}"
                                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Name</label>
                                            <p class="text-danger">{{ $order['customer']['name']}}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Email</label>
                                            <p class="text-danger">{{ $order['customer']['email']}}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Phone</label>
                                            <p class="text-danger">{{ $order['customer']['phone']}}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Order Date</label>
                                            <p class="text-danger">{{ $order->order_date}}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Order Invoice</label>
                                            <p class="text-danger">{{ $order->invoice_no}}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Payment Status</label>
                                            <p class="text-danger">{{ $order->paymet_status}}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Pay Amount</label>
                                            <p class="text-danger">{{ $order->pay}}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Due Amount</label>
                                            <p class="text-danger">{{ $order->due}}</p>
                                        </div>
                                    </div>
                                    <!-- end col -->

                                </div> <!-- end row -->

                                <div class="text-end">
                                    <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Complete Order</button>
                                </div>
                            </form>
                        </div>
                        <!-- end settings content-->


                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <table  class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>

                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                           @foreach ($orderItem as $item)
                                           <tr>
                                            <td><img src="{{asset($item->product->product_image)}}" style="width:50px;height:40px;" alt=""></td>

                                            <td>{{$item->product->product_name}}</td>
                                            <td>{{$item->product->porduct_code}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->product->selling_price}}</td>
                                            <td>{{$item->total}}</td>


                                        </tr>
                                           @endforeach

                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->

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
