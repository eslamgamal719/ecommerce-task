@extends('layouts.dashboard.app')

@section('content')

    <h2>Brands</h2>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Brands</li>
        </ol>
    </nav>

    <div class="tile mb-4">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-3 float-right">Add New Brand</a>
            </div>
        </div> <!-- end of row -->

        <div class="row">
            <div class="col-md-12">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($brands as $brand)
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>
                                     <img style="width: 100px" src="{{ asset('dashboard/brands/' . $brand->image) }}" alt="">
                                 </td>
                                 <td>{{ $brand->name }}</td>
                                 <td>
                                     @can('brand_edit')
                                         <a href="{{route('admin.brands.edit', $brand->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                     @else
                                         <a href="#" disabled="" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                     @endif


                                     @can('brand_delete')

                                         <form action="{{route('admin.brands.destroy', $brand->id)}}" method="post" style="display: inline-block">
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
                                No Brands Found
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    {{ $brands->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

@endsection
