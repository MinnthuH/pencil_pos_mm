@extends('admin_dashboard')

@section('title')
    Shop Stock | Pencil POS System
@endsection

@section('admin')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">{{ $shop->id }} Shop Stock</h4>
                    </div>
                </div>
            </div>

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
                                        @if (Auth::user()->can('admin.manage'))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stocks as $key => $item)
                                        <tr>
                                            <td>{{ $item->product->roll_no }}</td>
                                            <td><img src="{{ asset($item->product->product_image ?: 'upload/no_image.jpg') }}"
                                                    style="width:50px;height:40px;" alt=""></td>
                                            <td>{{ $item->product->product_name }}</td>
                                            <td>{{ $item->product->category->category_name }}</td>
                                            <td>
                                                {{ is_array(json_decode($item->product->product_code))
                                                    ? implode(', ', json_decode($item->product->product_code))
                                                    : $item->product->product_code }}
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-warning waves-effect waves-light">{{ $item->quantity }}</button>
                                            </td>

                                            @if (Auth::user()->can('admin.manage'))
                                                <td>
                                                    <button type="button" class="btn btn-blue" data-bs-toggle="modal"
                                                        data-bs-target="#shop-stock-modal" data-action="loss"
                                                        data-productid="{{ $item->product->id }}"
                                                        data-shopid="{{ $shop->id }}">
                                                        Loss
                                                    </button>
                                                    <button type="button" class="btn btn-blue" data-bs-toggle="modal"
                                                        data-bs-target="#shop-stock-modal" data-action="refound"
                                                        data-productid="{{ $item->product->id }}"
                                                        data-shopid="{{ $shop->id }}">
                                                        Refound
                                                    </button>
                                                    <button type="button" class="btn btn-blue" data-bs-toggle="modal"
                                                        data-bs-target="#shop-stock-modal" data-action="damage"
                                                        data-productid="{{ $item->product->id }}"
                                                        data-shopid="{{ $shop->id }}">
                                                        Damage
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shop Stock Modal -->
            <div id="shop-stock-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form id="shop-stock-form" class="px-3" action="{{ route('update.quantity') }}"
                                method="post">
                                @csrf
                                <input type="hidden" name="product_id" id="modal-product-id">
                                <input type="hidden" name="shop_id" id="modal-shop-id">
                                <input type="hidden" name="action" id="modal-action">

                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input class="form-control" type="number" id="quantity" name="quantity"
                                        placeholder="Enter quantity" required min="1">
                                </div>
                                <div class="mb-3 text-center">
                                    <button class="btn btn-blue" type="submit">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->

    <script src="{{ asset('backend/assets/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#shop-stock-modal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var action = button.data('action');
                var productId = button.data('productid');
                var shopId = button.data('shopid');

                console.log('Action:', action); // Debugging
                console.log('Product ID:', productId);
                console.log('Shop ID:', shopId);

                $('#modal-action').val(action);
                $('#modal-product-id').val(productId);
                $('#modal-shop-id').val(shopId);

                $('#modal-title').text(action.charAt(0).toUpperCase() + action.slice(1));
            });
        });
    </script>
@endsection
