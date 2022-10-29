@extends('layouts.dashboard.app')

@section('content')

    <div>
        <h2>Products</h2>
    </div>

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Products</a></li>
            <li class="breadcrumb-item active">Edit ( {{ $product->title }} )</li>
        </ul>


   <div class="row">
       <div class="col-md-12">
           <div class="tile mb-4">
               <form method="post" action="{{route('admin.products.update', $product->id)}}" enctype="multipart/form-data">
                   @csrf
                   @method('put')
                   @include('dashboard.partials._errors')

                   <div class="form-group">
                       <div class="row">
                           <div class="col-6">
                               <label class="">Title</label>
                               <input type="text" name="title" class="form-control" value="{{ $product->title }}">
                           </div>

                           <div class="col-6">
                               <label class="">Brand</label>
                               <select name="brand_id" class="form-control">
                                   <option value="" selected disabled>SELECT PRODUCT BRAND</option>
                                   @foreach($brands as $brand)
                                       <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-6">
                               <label class="">Stock</label>
                               <input type="number" min="0" name="stock" class="form-control" value="{{ $product->stock }}">
                           </div>


                           <div class="col-6">
                               <label class="">Price</label>
                               <input type="number" min="0" name="price" class="form-control" value="{{ $product->price }}">
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-12">
                               <label class="">SKU</label>
                               <input type="text" name="sku" class="form-control" value="{{ strtolower($product->sku) }}">
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-12">
                               <textarea name="details" id="" cols="206" rows="5">{{ $product->details }}</textarea>
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-12">
                               <input type="file" name="image">
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <button type="submit"  class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                   </div>

               </form>
           </div><!-- end of tile -->
       </div>
   </div>


@endsection
