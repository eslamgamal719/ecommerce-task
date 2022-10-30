<?php

namespace Tests\Feature\Frontend\UnauthenticatedActions;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;


    public function test_user_can_access_product_details_without_login()
    {
        $brand   = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $response = $this->get('/product-details/' . $product->id);

        $response->assertStatus(200);
        $response->assertViewIs('frontend.product-details');
        $response->assertViewHas('product');
    }

    public function test_user_can_access_products_shop_without_login()
    {
        $response = $this->get('/shop');

        $response->assertStatus(200);
        $response->assertViewIs('frontend.shop');
        $response->assertViewHas('products');
    }
}
