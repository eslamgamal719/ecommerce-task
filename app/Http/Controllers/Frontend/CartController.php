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
//        return view('');
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        $duplicates = Cart::search(function($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->product_id;
        });

        if($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Item is already in your cart!');
        }

        Cart::add($product->id, $product->title, 1, $product->price)->associate('App\Product');
//        return redirect()->route('cart.index')->with('success', 'Item added successfully');
        return Cart::count();
    }
}
