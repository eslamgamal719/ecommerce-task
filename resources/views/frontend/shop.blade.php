@extends('layouts.frontend.app')

@section('content')

    <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                    <div class="col-lg-6">
                        <h1 class="h2 text-uppercase mb-0">Shop</h1>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container p-0">
                <div class="row">
                    <div class="col-lg-12 order-1 order-lg-2 mb-5 mb-lg-0">
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-6">
                            </div>
                        </div>
                        <div class="row mb-5">

                            @foreach($products as $product)
                            <!-- PRODUCT-->
                            <div class="col-lg-4 col-sm-6">
                                <div class="product text-center">
                                    <div class="mb-3 position-relative">
                                        <div class="badge text-white badge-"></div>
                                        <a class="d-block" href="{{ route('product.details', $product->id) }}">
                                            <img class="img-fluid w-100" src="{{ asset('dashboard/products/' . $product->image) }}" alt="..."></a>
                                        <div class="product-overlay">
                                            <ul class="mb-0 list-inline">
                                                <li class="list-inline-item m-0 p-0">
                                                    <form action="{{ route('cart.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                        <button class="btn btn-sm btn-dark" type="submit">Add to cart</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h6> <a class="reset-anchor" href="detail.html">{{ $product->title }}</a></h6>
                                    <p class="small text-muted">${{ $product->price }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- PAGINATION-->
                        <nav aria-label="Page navigation example">
                            {{ $products->appends(request()->query())->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('script')
    @endpush
@endsection
