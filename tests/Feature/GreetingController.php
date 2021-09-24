<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GreetingController extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_greetings_list_can_be_retrieved()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-greetings']
        );

        $response = $this->get('/api/greetings');

        $response->assertOk();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_greetings_can_be_created()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['create-greetings']);
        $receiver = User::factory()->create(['email' => 'receiver@test.com']);
        $data = [
            'receiver' => $receiver->email,
            'title' => 'Hello',
            'text' => 'Hello World',
        ];
        $response = $this->post('/api/greetings', $data);

        $response->assertCreated();
    }
}
