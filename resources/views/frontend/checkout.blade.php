@extends('layouts.frontend.app')

@section('content')

    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Checkout</h1>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="cart.html">Cart</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <!-- BILLING ADDRESS-->
            <h2 class="h5 text-uppercase mb-4">Billing details</h2>
            <div class="row">
                <div class="col-lg-8">
                    <form action="{{ route('place.order') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="firstName">Full name</label>
                                <input name="full_name" class="form-control form-control-lg" id="firstName" type="text" placeholder="Enter your first name">
                                @error('full_name')<span class="alert-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="phone">Phone number</label>
                                <input name="mobile" class="form-control form-control-lg" id="phone" type="tel" placeholder="e.g. +02 245354745">
                                @error('mobile')<span class="alert-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="text-small text-uppercase" for="email">Email address</label>
                                <input name="email" class="form-control form-control-lg" id="email" type="email" placeholder="e.g. Jason@example.com">
                                @error('email')<span class="alert-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="text-small text-uppercase" for="address">Address line</label>
                                <input name="address" class="form-control form-control-lg" id="address" type="text" placeholder="House number and street name">
                                @error('address')<span class="alert-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="city">Town/City</label>
                                <input name="city" class="form-control form-control-lg" id="city" type="text">
                                @error('city')<span class="alert-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="text-small text-uppercase" for="state">State/County</label>
                                <input name="country" class="form-control form-control-lg" id="state" type="text">
                                @error('country')<span class="alert-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg-12 form-group">
                                <button class="btn btn-dark" type="submit">Place order (Cash on delivery)</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- ORDER SUMMARY-->
                <div class="col-lg-4">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Your order</h5>
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
@endpush
@endsection
