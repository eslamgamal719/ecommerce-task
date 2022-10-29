<?php

namespace Database\Seeders;

use App\Models\Brand;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = Brand::factory(2000)->make();
        $brands->chunk(500)->each(function($chunk) {
            Brand::insert($chunk->toArray());
        });
    }
}
