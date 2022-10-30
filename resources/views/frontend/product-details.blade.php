@extends('layouts.frontend.app')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <!-- PRODUCT SLIDER-->
                    <div class="row m-sm-0">
                        <div class="col-sm-10 order-1 order-sm-2">
                            <div class="owl-carousel product-slider" data-slider-id="1">
                                <a class="d-block" data-lightbox="product" title="Product item 1">
                                    <img class="img-fluid" src="{{ asset('dashboard/products/' . $product->image) }}" alt="...">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT DETAILS-->
                <div class="col-lg-6">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                        <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
                    </ul>
                    <h1>{{ $product->title }}</h1>
                    <p class="text-muted lead mt-4 mb-4">${{ $product->price }}</p>
                    <div class="row align-items-stretch mb-4">
                        <div class="col-sm-5 pr-sm-0">
                            <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                <div class="quantity">
                                    <button class="dec-btn p-0"><i class="fas fa-caret-left" onclick="decrease_qty()"></i></button>
                                    <input class="form-control border-0 shadow-0 p-0 product_qty" type="text" value="1">
                                    <button class="inc-btn p-0"><i class="fas fa-caret-right" onclick="increase_qty()"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 pl-sm-0">
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" value="" name="quantity" class="product_quantity">
                                <button class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" style="height: 48px !important;" type="submit">Add to cart</button>
                            </form>
                        </div>
                    <ul class="list-unstyled small d-inline-block mt-5" style="position: absolute;">
                        <li class="px-3 py-2 mb-1 bg-white mt-5"><strong class="text-uppercase">SKU:</strong><span class="ml-2 text-muted">{{ $product->sku }}</span></li>
                        <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">Brand:</strong><a class="reset-anchor ml-2" href="{{ url("shop?brand_id=" . $product->brand_id) }}">{{ $product->brand->name }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- DETAILS TABS-->
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active mt-5" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <h6 class="text-uppercase">Product description </h6>
                        <p class="text-muted text-small mb-0">{{ $product->details }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    @push('script')
        <script>
            function increase_qty() {
                var qty = Number($('.product_qty').val()) + 1;
                $('.product_quantity').val(qty);
            }

            function decrease_qty() {
                var qty = Number($('.product_qty').val()) - 1;
                $('.product_quantity').val(qty);
            }
        </script>
    @endpush
@endsection
