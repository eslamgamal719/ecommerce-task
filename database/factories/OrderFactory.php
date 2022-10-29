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
        $subtotal   = mt_rand(500, 3000);
        $tax        = mt_rand(50, 400);
        $total      = $subtotal + $tax;
        return [
            'full_name' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'email'     => $this->faker->safeEmail,
            'mobile' => $this->faker->numerify('010########'),
            'address' => $this->faker->sentence,
            'city' => $this->faker->word,
            'country' => $this->faker->word,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'user_id' => mt_rand(2, 100)
        ];
    }
}
