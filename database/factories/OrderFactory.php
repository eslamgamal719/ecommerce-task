<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $products = Product::hasQuantity()->inRandomOrder()->take(2)->get();
//        $total = $products->sum('price');

        return [
            'total' => mt_rand(500, 3000),
            'user_id' => mt_rand(2, 100)
        ];
    }
}
