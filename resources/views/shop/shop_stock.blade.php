@extends('admin_dashboard')

@section('admin')
@section('title')
    Shop Stock | Pencil POS System
@endsection

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ $shop->name }} Shop Stock</h4>
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
                                    @if (Auth::user()->can('warehouse.edit'))
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stocks as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ asset($item->product->product_image ?: 'upload/no_image.jpg') }}" style="width:50px;height:40px;" alt=""></td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->product->category->category_name }}</td>
                                        <td>{{ $item->product->product_code }}</td>
                                        <td>
                                            <button class="btn btn-warning waves-effect waves-light">{{ $item->quantity }}</button>
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
                            <input type="hidden" name="shopId" id="shop-id-input">
                            <div class="mb-3">
                                <label for="transferStock" class="form-label">လွှဲပြောင်းမည့် ကုန်ပစ္စည်း အရေအတွက်</label>
                                <input class="form-control" type="number" id="transferStock" name="transferStock" placeholder="လွှဲေပြာင်းမည့် ကုန်ပစ္စည်း အရေအတွက်ထည့်ပါ" required min="1">
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-blue" type="submit">Transfer</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div> <!-- container -->
</div> <!-- content -->

<script>
    $(document).ready(function() {
        $('#signup-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var productId = button.data('productid'); // Extract product ID from data attribute
            var shopId = button.data('shopid'); // Extract shop ID from data attribute
            $('#product-id-input').val(productId); // Set the value in the hidden input field
            $('#shop-id-input').val(shopId); // Set the value in the hidden input field
        });
    });
</script>

@endsection
