@extends('layouts.dashboard.app')


@section('content')

    <h2>Dashboard</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>{{ $users_count }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-product-hunt fa-3x"></i>
                <div class="info">
                    <h4>Products</h4>
                    <p><b>{{ $products_count }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-home fa-3x"></i>
                <div class="info">
                    <h4>Brands</h4>
                    <p><b>{{ $brands_count }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-list fa-3x"></i>
                <div class="info">
                    <h4>Orders</h4>
                    <p><b>{{ $orders_count }}</b></p>
                </div>
            </div>
        </div>
    </div>


    <div class="tile mt-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover mt-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Creator/Updator Name</th>
                        <th>Subject Type</th>
                        <th>Subject ID</th>
                        <th>Description</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($activities as $activity)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \App\Models\User::find($activity->causer_id)->full_name }}</td>
                            <td>{{ explode("\\", $activity->subject_type)[2] }}</td>
                            <td>{{ $activity->subject_id }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->description == 'created' ? $activity->created_at : $activity->updated_at }}</td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
                    {{ $activities->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
