<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $selected_columns = ['id', 'full_name', 'email', 'mobile', 'total', 'tax', 'status'];
        $orders = Order::orderBy('id', 'desc')->select($selected_columns)->paginate(config('constants.paginator'));
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('dashboard.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        if($order->delete()) {
            activity()->causedBy(auth()->user())->performedOn($order)->createdAt(now())->log('deleted');
            return redirect()->route('admin.orders.index')->with(['success' => 'Order deleted successfully']);
        }
        return redirect()->route('admin.orders.index')->with(['error' => 'Operation not done, there is an error']);
    }

    public function update_status(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();

        activity()->causedBy(auth()->user())->performedOn($order)->createdAt(now())->log('updated');
    }

}
