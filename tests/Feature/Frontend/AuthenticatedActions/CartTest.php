<?php

namespace Tests\Feature\Frontend\AuthenticatedActions;

use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;


    public function test_authenticated_user_can_access_cart_page()
    {
        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/cart');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_add_to_cart()
    {
        $client = User::factory()->create();

        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id'  => $brand->id]);

        $response = $this->actingAs($client)->post('/cart', [
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success');
    }

    public function test_unauthenticated_user_can_not_access_cart_page()
    {
        $response = $this->get('/cart');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
