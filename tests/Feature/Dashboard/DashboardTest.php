<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;


    public function test_authenticated_admin_can_access_dashboard_page()
    {
        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.welcome');
    }

    public function test_authenticated_client_can_not_access_dashboard_page()
    {
        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_dashboard_page_show_data_statistics()
    {
        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertViewHasAll(['users_count', 'products_count', 'brands_count', 'orders_count']);
    }
}
