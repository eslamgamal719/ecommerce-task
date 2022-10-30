<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $data['brands'] = Brand::select(['id', 'name', 'image'])->take(4)->get();
        $data['products'] = Product::select(['id', 'title', 'price', 'image'])->take(8)->get();

        return view('frontend.home', $data);
    }
}
