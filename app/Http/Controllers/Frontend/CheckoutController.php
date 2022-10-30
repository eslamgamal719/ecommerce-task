<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use \Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout');
    }

    public function place_order(OrderRequest $request)
    {
        $contents = Cart::content();

        $data['full_name']  = $request->full_name;
        $data['email']      = $request->email;
        $data['mobile']     = $request->mobile;
        $data['address']    = $request->address;
        $data['city']       = $request->city;
        $data['country']    = $request->country;
        $data['subtotal']   = Cart::subTotal();
        $data['tax']        = Cart::tax();
        $data['total']      = Cart::total();
        $data['user_id']    = auth()->id();

        $order = Order::create($data);
        $product_ids = [];

        if($order) {

            foreach($contents as $index => $pro) {
                array_push($product_ids, $pro->id);
                $product = Product::find($pro->id);
                $product->update([
                    'stock' => $product->stock - $pro->qty
                ]);
            }

            $order->products()->attach($product_ids);
            Cart::destroy();

            return redirect()->route('home')->with('success', 'Order placed successfully, shipping company will contact you within 3 work days');
        }
        return redirect()->route('home')->with('error', 'Operation not done, please try again!');
    }
}
