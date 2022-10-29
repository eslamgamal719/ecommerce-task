@extends('layouts.dashboard.app')

@section('content')

    <div>
        <h2>Brands</h2>
    </div>

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.brands.index')}}">brands</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ul>


   <div class="row">
       <div class="col-md-12">
           <div class="tile mb-4">
               <form method="post" action="{{route('admin.brands.store')}}" enctype="multipart/form-data">
                   @csrf
                   @method('post')
                   @include('dashboard.partials._errors')

                   <div class="form-group">
                       <label class="">Name</label>
                       <input type="text" name="name" class="form-control" value="{{old('name')}}">
                   </div>

                   <div class="form-group">
                       <div class="row">
                           <div class="col-12">
                               <input type="file" name="image">
                           </div>
                       </div>
                   </div>

                   <div class="form-group">
                       <button type="submit"  class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                   </div>

               </form>
           </div><!-- end of tile -->
       </div>
   </div>


@endsection
