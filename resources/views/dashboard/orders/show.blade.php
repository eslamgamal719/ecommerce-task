@extends('layouts.dashboard.app')

@section('content')

    <div>
        <h2>Order</h2>
    </div>

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.orders.index')}}">Orders</a></li>
            <li class="breadcrumb-item active">Order</li>
        </ul>


   <div class="row">
       <div class="col-md-12">
           <div class="tile mb-4">
               <form>
                   <div class="form-group">
                       <div class="row">
                           <div class="col-4">
                               <label class="">Full Name</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->full_name }}">
                            </div>

                           <div class="col-4">
                               <label class="">Email</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->email }}">
                           </div>

                           <div class="col-4">
                               <label class="">Mobile</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->mobile }}">
                           </div>
                        </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-4">
                               <label class="">Address</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->address }}">
                           </div>

                           <div class="col-4">
                               <label class="">City</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->city }}">
                           </div>

                           <div class="col-4">
                               <label class="">Country</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->country }}">
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-4">
                               <label class="">Subtotal</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->subtotal }}">
                           </div>

                           <div class="col-4">
                               <label class="">Tax</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->tax }}">
                           </div>

                           <div class="col-4">
                               <label class="">Total</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->total }}">
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-12">
                               <label class="">Status</label>
                               <input type="text" disabled name="name" class="form-control" value="{{ $order->status }}">
                           </div>
                       </div>
                   </div>

                   <table class="table table-hover" style="margin-top: 70px">

                       <thead>
                       <tr>
                           <th>#</th>
                           <th>Image</th>
                           <th>Title</th>
                           <th>Brand</th>
                           <th>Price</th>
                           <th>SKU</th>
                       </tr>
                       </thead>
                       <tbody>
                       @forelse($order->products as $product)
                           <tr>
                               <td>{{ $loop->iteration }}</td>
                               <td>
                                   <img style="width: 100px" src="{{ asset('dashboard/products/' . $product->image) }}" alt="">
                               </td>
                               <td>{{ $product->title }}</td>
                               <td>{{ $product->brand->name }}</td>
                               <td>{{ $product->price }}</td>
                               <td>{{ $product->sku }}</td>
                           </tr>
                       @empty
                           <tr>
                               No Products Found
                           </tr>
                       @endforelse
                       </tbody>
                   </table>


               </form>
           </div><!-- end of tile -->
       </div>
   </div>


@endsection
