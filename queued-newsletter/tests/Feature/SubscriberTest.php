<?php
// tests/Feature/SubscriberTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    use RefreshDatabase;

    public function test_subscriber_can_subscribe()
    {
        $response = $this->post(route('subscribe.submit'), [
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);

        $response->assertRedirect(route('success'));
        $this->assertDatabaseHas('subscribers', ['email' => 'john@example.com']);
    }
}