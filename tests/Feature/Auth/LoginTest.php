<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_wrong_credentials()
    {
        User::factory()->create([
            'email' => 'eslam@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $response = $this->post('/login', ['email' => 'eslam@gmail.com', 'password' => '11111111']);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_login_with_valid_credentials()
    {
        User::factory()->create([
            'email' => 'eslam@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $response = $this->post('/login', ['email' => 'eslam@gmail.com', 'password' => '123456789']);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}
