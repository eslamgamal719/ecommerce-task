<?php

namespace Tests\Feature\Dashboard;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandsManagementTest extends TestCase
{
    use RefreshDatabase;


    public function test_authenticated_admin_can_access_brands_list_in_dashboard()
    {
        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/brands');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.brands.index');
    }

    public function test_authenticated_client_can_not_access_brands_list_in_dashboard()
    {
        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin/brands');

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_authenticated_admin_can_access_create_brand_page()
    {
        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/brands/create');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.brands.create');
    }

    public function test_authenticated_client_can_not_access_create_brand_page()
    {
        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin/brands/create');

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_authenticated_admin_can_access_edit_brand_page()
    {
        $brand = Brand::factory()->create();

        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/brands/' . $brand->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.brands.edit');
    }

    public function test_authenticated_client_can_not_access_edit_brand_page()
    {
        $brand = Brand::factory()->create();

        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin/brands/' . $brand->id . '/edit');

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_authenticated_admin_can_delete_brand()
    {
        $brand = Brand::factory()->create();

        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->delete('/admin/brands/' . $brand->id);

        $response->assertRedirect(route('admin.brands.index'));
        $response->assertSessionHas('success');
    }

    public function test_authenticated_client_can_not_delete_brand()
    {
        $brand = Brand::factory()->create();

        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin/brands/' . $brand->id);

        $response->assertRedirect('/home');
    }
}
