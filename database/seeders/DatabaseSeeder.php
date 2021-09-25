<?php

namespace Database\Seeders;

use App\Models\Greeting;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->admin()->create();
        Role::factory()->user()->create();
        User::factory(10)->create();
        Greeting::factory(10)->create();
    }
}
