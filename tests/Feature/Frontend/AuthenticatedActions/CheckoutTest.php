<?php

namespace Tests\Feature\Frontend\AuthenticatedActions;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_authenticated_user_can_access_checkout_page()
    {
        $client = User::factory()->create();

        $response = $this->actingAs($client)->get('/checkout');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_make_place_order()
    {
        $client = User::factory()->create();

        $data['full_name']  = $client->full_name;
        $data['email']      = $client->email;
        $data['mobile']     = $client->mobile;
        $data['address']    = '7 street maadi';
        $data['city']       = 'Cairo';
        $data['country']    = 'Egypt';
        $data['subtotal']   = 1000;
        $data['tax']        = 100;
        $data['total']      = 1100;
        $data['user_id']    = $client->id;

        $response = $this->actingAs($client)->post('/checkout', $data);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');
    }

    public function test_unauthenticated_user_can_not_access_checkout_page()
    {
        $response = $this->get('/checkout');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
