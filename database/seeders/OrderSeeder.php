<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::factory(5000)->make();
        $orders->chunk(20000)->each(function($chunk) {
           Order::insert($chunk->toArray());
        });
    }
}
