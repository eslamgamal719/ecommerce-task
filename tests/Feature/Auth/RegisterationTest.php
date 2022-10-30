<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterationTest extends TestCase
{
    use RefreshDatabase;

    public $data = [];

    public function setUp()
    : void
    {
        parent::setUp();
        $this->data = [
            'full_name' => $this->faker->name,
            'email'     => $this->faker->safeEmail(),
            'mobile'    => $this->faker->numerify('010########'),
            'role_name' => 'client',
            'password'  => '123456789',
            'password_confirmation'  => '123456789',
        ];
    }

    public function test_register_with_invalid_data()
    {
        $this->data['full_name'] = '';

        $response = $this->postJson('/register', $this->data);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('users', [
            'email' => $this->data['email'],
        ]);
    }

    public function test_register_with_valid_data()
    {
        $this->seed([
            PermissionSeeder::class,
            RoleSeeder::class
        ]);

        $response = $this->postJson('/register', $this->data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => $this->data['email'],
        ]);
    }
}
