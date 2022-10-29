<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(12000)->make();
        $products->chunk(2000)->each(function($chunk) {
           Product::insert($chunk->toArray());
        });
    }
}
