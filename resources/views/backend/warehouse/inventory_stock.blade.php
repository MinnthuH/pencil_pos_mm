@extends('admin_dashboard')


@section('admin')
@section('title')
    Stock Inventory | Pencil POS System
@endsection
<script type="text/javascript" src="{{ asset('backend/assets/jquery.js') }}"></script>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">စတိုကုန်ပစ္စည်း လက်ကျန် စာရင်း</h4>
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
                                    <th>စဉ်</th>
                                    <th>ဓါတ်ပုံ</th>
                                    <th>ကုန်ပစ္စည်းအမည်</th>
                                    <th>အမျိုးအစား</th>
                                    <th>Code</th>
                                    <th>လက်ကျန်</th>
                                    <th>ဆိုင်သို့လွှဲရန်</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($inventory as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->product->product_image) }}"
                                                style="width:50px;height:40px;" alt=""></td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->product->category->category_name }}</td>
                                        <td>{{ $item->product->product_code }}</td>
                                        <td>
                                            <button
                                                class="btn btn-warning waves-effect waves-light">{{ $item->total_buy_qty }}</button>
                                        </td>
                                        <td>
                                            @if (Auth::user()->can('warehouse.edit'))
                                                <a href="#" class="btn btn-info sm" data-bs-toggle="modal"
                                                    data-bs-target="#signup-modal"
                                                    data-productid="{{ $item->product_id }}" title="Transfer">
                                                    <i class="fas fa-chart-line"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Signup modal content -->
        <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="px-3" action="{{ route('transfer.stock') }}" method="post">
                            @csrf
                            <input type="hidden" name="productId" id="product-id-input">
                            <div class="mb-3">
                                <label for="stock" class="form-label">လွှဲေပြာင်းမည့် ကုန်ပစ္စည်း အရေအတွက်</label>
                                <input class="form-control" type="number" id="naem" name="transferStock"
                                    placeholder="လွှဲေပြာင်းမည့် ကုန်ပစ္စည်း အရေအတွက်ထည့်ပါ" required min="1">
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-blue" type="submit">Transfer</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script>
            $(document).ready(function() {
                $('#signup-modal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var productId = button.data('productid'); // Extract product ID from data attribute
                    $('#product-id-input').val(productId); // Set the value in the hidden input field
                });
            });
        </script>


    @endsection
