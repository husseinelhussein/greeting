<?php

namespace Database\Factories;

use App\Models\Greeting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GreetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Greeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();
        return [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'sender_id' => $this->faker->randomElement($users),
            'receiver_id' => $this->faker->randomElement($users),
        ];
    }
}
