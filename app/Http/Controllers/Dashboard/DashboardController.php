<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $data['users_count'] = User::all()->count();
        $data['products_count'] = Product::all()->count();
        $data['brands_count'] = Brand::all()->count();
        $data['orders_count'] = Order::all()->count();
        $data['activities'] = Activity::paginate(config('constants.paginator'));

        return view('dashboard.welcome', $data);
    }
}
