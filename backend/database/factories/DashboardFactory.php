<?php

namespace Database\Factories;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DashboardFactory extends Factory
{
    protected $model = Dashboard::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->sentence(3),
            'current_version_id' => null,
        ];
    }
}
