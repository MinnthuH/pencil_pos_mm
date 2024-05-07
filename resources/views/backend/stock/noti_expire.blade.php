@extends('admin_dashboard')


@section('admin')
@section('title')
    All Stock | Pencil POS System
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
                    <h4 class="page-title">သက်တမ်းကုန်ခါနီး ပစ္စည်းများ စာရင်း</h4>
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
                                    <th>တင်သွင်းသူ</th>
                                    <th>Code</th>
                                    <th>သက်တမ်းကုန်ဆုံးရက်</th>
                                    <th>လက်ကျန်</th>
                                    <th>ပယ်ဖျက်ရန်</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->product_image ?: 'upload/no_image.jpg') }}"
                                                style="width:50px;height:40px;" alt=""></td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item['category']['category_name'] }}</td>
                                        <td>{{ $item['supplier']['name'] }}</td>
                                        <td>{{ $item->product_code }}</td>
                                        <td class="text-danger">{{ $item->expire_date }}</td>
                                        <td>
                                            <button
                                                class="btn btn-warning waves-effect waves-light">{{ $item->product_store }}</button>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info sm" data-bs-toggle="modal"
                                                data-bs-target="#signup-modal" data-productid="{{ $item->id }}"
                                                title="Add Stock"><i class="fas fa-chart-line"></i></a>
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
                        <h2 class="mb-3 text-center">သက်တမ်းကုန်ပစ္စည်း ပယ်ဖျက်ရန်</h2>
                        <form class="px-3" action="{{ route('reduce.stock') }}" method="post">
                            @csrf
                            <input type="hidden" name="productId" id="product-id-input">
                            <div class="mb-3">
                                <label for="stock" class="form-label mb-2">ပယ်ဖျက်မည့်အရေအတွက်</label>
                                <input class="form-control" type="number" id="naem" name="reduceStock"
                                    placeholder="ပယ်ဖျက်လိုသည့် အရေအတွက်ထည့်ပါ">
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-blue" type="submit">ပယ်ဖျက်မည်</button>
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
