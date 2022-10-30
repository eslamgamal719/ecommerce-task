@extends('layouts.dashboard.app')

@section('content')

    <h2>Orders</h2>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
    </nav>

    <div class="tile mb-4">
        <div class="row">
            <div class="col-md-12">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{{ $order->full_name }}</td>
                                 <td>{{ $order->email }}</td>
                                 <td>{{ $order->mobile }}</td>
                                 <td>${{ $order->tax }}</td>
                                 <td>${{ $order->total }}</td>
                                 <td>
                                     <select class="form-control change_status_{{ $order->id }}" name="status" onchange="change_status({{ $order->id }})">
                                         <option value="pending" {{ $order->status == "pending" ? "selected" : '' }}>Pending</option>
                                         <option value="paid" {{ $order->status == "paid" ? "selected" : '' }}>Paid</option>
                                         <option value="canceled" {{ $order->status == "canceled" ? "selected" : '' }}>Canceled</option>
                                     </select>
                                 </td>
                                 <td>
                                     @can('product_edit')
                                         <a href="{{route('admin.orders.show', $order->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i>Show</a>
                                     @else
                                         <a href="#" disabled="" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i>Edit</a>
                                     @endif


                                     @can('product_delete')

                                         <form action="{{route('admin.orders.destroy', $order->id)}}" method="post" style="display: inline-block">
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
                                No Orders Found
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        function change_status(order_id) {
            var value = $('.change_status_' + order_id).val();
            $.ajax({
                url: "{{ route('admin.order.update.status') }}",
                method: "POST",
                data: {
                    "order_id": order_id,
                    "status": value,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    location.href = '/admin/orders';
                }
            });
        }
    </script>
@endpush
@endsection
