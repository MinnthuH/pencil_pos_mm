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
                        <ol class="breadcrumb m-0">
                            @if (Auth::user()->can('admin.manage'))
                                <a href="{{ route('stock.import') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light ms-2"> Stock Import</a>

                                <a href="{{ route('mass.transfer') }}"
                                class="btn btn-blue rounded-pill waves-effect waves-light ms-2">Many Transfer</a>

                                <a href="{{ route('export.stock') }}"
                                    class="btn btn-blue rounded-pill waves-effect waves-light ms-2"> Export</a>
                                &nbsp;
                            @endif
                        </ol>
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
                                        <td><img src="{{ asset($item->product_image ?: 'upload/no_image.jpg') }}" style="width:50px;height:40px;" alt=""></td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->category->category_name }}</td>
                                        <td>{{ $item->product_code }}</td>
                                        <td>
                                            <button class="btn btn-warning waves-effect waves-light">{{ $item->product_store }}</button>
                                        </td>
                                        <td>
                                            @if (Auth::user()->can('warehouse.edit'))
                                                <a href="#" class="btn btn-info sm" data-bs-toggle="modal" data-bs-target="#signup-modal" data-productid="{{ $item->id }}" title="Transfer">
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
                                <label for="shopId" class="form-label">ဆိုင်အမည်</label>
                                <select name="shopId" class="form-select" id="shopId">
                                    <option selected disabled>ဆိုင်အမည် အရွေးချယ်ပါ</option>
                                    @foreach ($shops as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
            console.log('Product ID:', productId); // Debugging log
            $('#product-id-input').val(productId); // Set the value in the hidden input field
        });
    });
</script>

@endsection
