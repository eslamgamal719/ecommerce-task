<?php

namespace Tests\Feature\Frontend\UnauthenticatedActions;

use Tests\TestCase;

class HomePageTest extends TestCase
{

    public function test_user_can_access_home_page_without_login()
    {
        $response = $this->get('/home');

        $response->assertStatus(200);
        $response->assertViewIs('frontend.home');
    }

    public function test_home_page_contains_lists_of_brands_and_products()
    {
        $response = $this->get('/home');

        $response->assertViewHasAll(['brands', 'products']);
    }
}
