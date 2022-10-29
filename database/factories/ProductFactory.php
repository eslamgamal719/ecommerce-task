<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$brand = Brand::inRandomOrder()->first()->id;
        return [
            'title'     => $this->faker->name,
            'sku'       => strtoupper(Str::random(8)),
            'details'   => $this->faker->paragraph,
            'price'     => $this->faker->numberBetween(50, 500),
            'stock'     => $this->faker->numberBetween(1, 30),
            'image'     => 'product-' . $this->faker->numberBetween(1, 12) . '.jpg',
            'brand_id'  => mt_rand(1, 2000)
        ];
    }
}
