<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use \Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        return view('frontend.cart');
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        $duplicates = Cart::search(function($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->product_id;
        });
        $quantity = ($request->quantity > 1) ? $request->quantity : 1;

        if($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Item is already in your cart!');
        }

        Cart::add($product->id, $product->title, $quantity, $product->price)->associate('App\Models\Product');
        return redirect()->route('cart.index')->with('success', 'Item added successfully');
    }

    public function update(Request $request)
    {
        if(Cart::update($request->rowId, $request->qty_value)) {
            return true;
        }
        return false;
    }

    public function destroy(Request $request)
    {
        if(Cart::remove($request->rowId)) {
            return true;
        }
        return false;
    }
}
