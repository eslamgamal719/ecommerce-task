<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{

    public function shop()
    {
        $selected_columns = ['id', 'image', 'title', 'sku', 'price', 'stock', 'brand_id'];

        if(request()->brand_id) {
            $products = Product::select($selected_columns)
                ->where('brand_id', request()->brand_id)
                ->orderBy('id', 'desc')
                ->paginate(12);
            return view('frontend.shop', compact('products'));
        }

        $products = Product::select($selected_columns)->orderBy('id', 'desc')->paginate(12);

        return view('frontend.shop', compact('products'));
    }

    public function product_details(Product $product)
    {
        return view('frontend.product-details', compact('product'));
    }
}
