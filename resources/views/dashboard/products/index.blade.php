@extends('layouts.dashboard.app')

@section('content')

    <h2>Products</h2>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
    </nav>

    <div class="tile mb-4">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3 float-right">Add New Product</a>
            </div>
        </div> <!-- end of row -->

        <div class="row">
            <div class="col-md-12">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>SKU</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>
                                     <img style="width: 100px" src="{{ asset('dashboard/products/' . $product->image) }}" alt="">
                                 </td>
                                 <td>{{ $product->title }}</td>
                                 <td>{{ $product->brand->name }}</td>
                                 <td>{{ $product->price }}</td>
                                 <td>{{ $product->stock }}</td>
                                 <td>{{ $product->sku }}</td>
                                 <td>
                                     @can('product_edit')
                                         <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                     @else
                                         <a href="#" disabled="" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                     @endif


                                     @can('product_delete')

                                         <form action="{{route('admin.products.destroy', $product->id)}}" method="post" style="display: inline-block">
                                             @csrf
                                             @method('delete')
                                             <button type="submit" class="btn btn-danger btn-sm delete" ><i class="fa fa-trash"></i>Delete</button>
                                         </form>

                                     @else
                                         <a href="#" disabled="" class="btn btn-danger btn-sm"><i class="fa fa-edit"></i>Delete</a>
                                     @endif
                                 </td>
                             </tr>
                        @empty
                            <tr>
                                No Products Found
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

@endsection
