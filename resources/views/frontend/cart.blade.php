@extends('layouts.frontend.app')

@section('content')

    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Cart</h1>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <!-- CART TABLE-->
                    <div class="table-responsive mb-4">
                        @if(Cart::count() > 0)
                        <table class="table">
                            <thead class="bg-light">
                            <tr>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Product</strong></th>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Price</strong></th>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantity</strong></th>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                                <th class="border-0" scope="col"> </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Cart::content() as $item)
                            <tr>
                                <th class="pl-0 border-0" scope="row">
                                    <div class="media align-items-center">
                                        <a class="reset-anchor d-block animsition-link" href="detail.html">
                                            <img src="{{ asset('dashboard/products/' . $item->model->image) }}" alt="..." width="70"/></a>
                                        <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="detail.html">{{ $item->name }}</a></strong></div>
                                    </div>
                                </th>
                                <td class="align-middle border-0">
                                    <p class="mb-0 small">${{ $item->price }}</p>
                                </td>
                                <td class="align-middle border-0">
                                    <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span>
                                        <div class="quantity">
                                            <button class="dec-btn p-0" onclick="decrease_item('{{ $item->rowId }}')"><i class="fas fa-caret-left"></i></button>
                                            <input class="form-control form-control-sm border-0 shadow-0 p-0 qty_value_{{ $item->rowId }}" type="text" value="{{ $item->qty }}"/>
                                            <button class="inc-btn p-0" onclick="increase_item('{{ $item->rowId }}')"><i class="fas fa-caret-right"></i></button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle border-0">
                                    <p class="mb-0 small">${{ $item->price * $item->qty }}</p>
                                </td>
                                <td class="align-middle border-0">
                                    <button class="reset-anchor" onclick="remove_item('{{ $item->rowId }}')">
                                        <i class="fas fa-trash-alt small text-muted"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                    <!-- CART NAV-->
                    <div class="bg-light px-4 py-3">
                        <div class="row align-items-center text-center">
                            <div class="col-md-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm" href="{{ route('home') }}"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Continue shopping</a></div>
                            <div class="col-md-6 text-md-right">
                                <a class="btn btn-outline-dark btn-sm" href="{{ route('checkout.index') }}">
                                    Procceed to checkout<i class="fas fa-long-arrow-alt-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ORDER TOTAL-->
                <div class="col-lg-4">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Cart total</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center justify-content-between">
                                    <strong class="text-uppercase small font-weight-bold">Subtotal</strong>
                                    <span class="text-muted small">${{ Cart::subTotal() }}</span>
                                </li>
                                <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <strong class="text-uppercase small font-weight-bold">Tax</strong>
                                    <span class="text-muted small">${{ Cart::tax() }}</span>
                                </li>
                                <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between mb-4">
                                    <strong class="text-uppercase small font-weight-bold">Total</strong>
                                    <span>${{ Cart::total() }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@push('script')
    <script>
        function increase_item(rowId) {
            var value = Number($('.qty_value_' +  rowId ).val()) + 1;
            $.ajax({
                url: "{{ route('cart.update') }}",
                method: "POST",
                data: {
                    "rowId": rowId,
                    "qty_value": value,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    location.href = '/cart';
                }
            });
        }

        function decrease_item(rowId) {
            var value = Number($('.qty_value_' + rowId).val()) - 1;
            $.ajax({
                url: "{{ route('cart.update') }}",
                method: "POST",
                data: {
                    "rowId": rowId,
                    "qty_value": value,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    location.href = '/cart';
                }
            });
        }

        function remove_item(rowId) {
            $.ajax({
                url: "{{ route('cart.destroy') }}",
                method: "POST",
                data: {
                    "rowId": rowId,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    location.href = '/cart';
                }
            });
        }
    </script>
@endpush
@endsection
