<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = Role::all()->pluck('name')->toArray();
        $adminExists = in_array('admin', $roles);
        $userExists = in_array('user', $roles);
        return [
            'name' => $adminExists? ($userExists? $this->faker->name(): "user"): "admin",
        ];
    }
}
