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
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-list fa-3x"></i>
                <div class="info">
                    <h4>Products</h4>
                    <p><b>{{ $products_count }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-list fa-3x"></i>
                <div class="info">
                    <h4>Brands</h4>
                    <p><b>{{ $brands_count }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-play fa-3x"></i>
                <div class="info">
                    <h4>Orders</h4>
                    <p><b>{{ $orders_count }}</b></p>
                </div>
            </div>
        </div>
    </div>

    @endsection
