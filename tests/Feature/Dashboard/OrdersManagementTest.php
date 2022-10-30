<?php

namespace Tests\Feature\Dashboard;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdersManagementTest extends TestCase
{
    use RefreshDatabase;


    public function test_authenticated_admin_can_access_orders_list_in_dashboard()
    {
        $admin = User::factory()->create(['role_name' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/orders');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.orders.index');
    }

    public function test_authenticated_client_can_not_access_brands_list_in_dashboard()
    {
        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/admin/orders');

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_authenticated_admin_can_access_show_order_page()
    {
        $admin = User::factory()->create(['role_name' => 'admin']);
        $client = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $client->id]);

        $response = $this->actingAs($admin)->get('/admin/orders/' . $order->id);

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.orders.show');
    }

    public function test_authenticated_client_can_not_access_show_order_page()
    {
        $client = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $client->id]);

        $response = $this->actingAs($client)->get('/admin/orders/' . $order->id);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function test_authenticated_admin_can_delete_order()
    {
        $admin = User::factory()->create(['role_name' => 'admin']);
        $client = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $client->id]);

        $response = $this->actingAs($admin)->delete('/admin/orders/' . $order->id);

        $response->assertRedirect(route('admin.orders.index'));
        $response->assertSessionHas('success');
    }

    public function test_authenticated_client_can_not_delete_order()
    {
        $client = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $client->id]);

        $response = $this->actingAs($client)->delete('/admin/orders/' . $order->id);

        $response->assertRedirect('/home');
    }


}
