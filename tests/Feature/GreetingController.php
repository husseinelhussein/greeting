<?php

namespace Tests\Feature;

use App\Models\Greeting;
use App\Models\User;
use Illuminate\Support\Collection;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GreetingController extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests the listing functionality.
     *
     * @return void
     */
    public function test_greetings_list_can_be_retrieved()
    {
        User::factory(2)->create();
        Greeting::factory(30)->create();
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-greetings']
        );

        $response = $this->get('/api/greetings');

        $response->assertOk();

        $content = json_decode($response->baseResponse->getContent(), true);
        $this->assertGreaterThan(0, count($content['data']));
    }

    /**
     * Tests listing the received greetings.
     *
     * @return void
     */
    public function test_received_list_can_be_retrieved()
    {
        $users = User::factory(2)->create();
        $greetings = Greeting::factory(30)->create();
        /** @var User $user */
        $user = $users->first();
        $received = $user->received()->get();
        $this->assertGreaterThan(0, $received->count());
        Sanctum::actingAs(
            $user,
            ['view-greetings']
        );
        $response = $this->get('/api/greetings/received');
        $response->assertOk();
        $content = json_decode($response->baseResponse->getContent(), true);
        $this->assertGreaterThan(0, count($content['data']));
    }

    /**
     * Tests listing the sent greetings.
     *
     * @return void
     */
    public function test_sent_cards_list_can_be_retrieved()
    {
        $users = User::factory(2)->create();
        Greeting::factory(30)->create();
        /** @var User $user */
        $user = $users->first();
        $sent = $user->sent()->get();
        $this->assertGreaterThan(0, $sent->count());
        Sanctum::actingAs(
            $user,
            ['view-greetings']
        );
        $response = $this->get('/api/sent');
        $response->assertOk();
        $content = json_decode($response->baseResponse->getContent(), true);
        $this->assertGreaterThan(0, count($content['data']));
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
