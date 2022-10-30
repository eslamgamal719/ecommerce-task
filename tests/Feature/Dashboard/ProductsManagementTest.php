<?php

namespace Tests\Feature\Dashboard;

use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsManagementTest extends TestCase
{
    use RefreshDatabase;


    public function test_authenticated_admin_can_access_products_list_in_dashboard()
    {
        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/products');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.products.index');
    }

    public function test_authenticated_client_can_not_access_products_list_in_dashboard()
    {
        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin/products');

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_authenticated_admin_can_access_create_product_page()
    {
        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/products/create');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.products.create');
    }

    public function test_authenticated_client_can_not_access_create_product_page()
    {
        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin/products/create');

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_authenticated_admin_can_access_edit_product_page()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/products/' . $product->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.products.edit');
    }

    public function test_authenticated_client_can_not_access_edit_product_page()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin/products/' . $product->id . '/edit');

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_authenticated_admin_can_delete_product()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->delete('/admin/products/' . $product->id);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success');
    }

    public function test_authenticated_client_can_not_delete_product()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin/products/' . $product->id);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}
