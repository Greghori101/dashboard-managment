<?php

namespace Database\Factories;

use App\Models\Version;
use App\Models\Dashboard;
use Illuminate\Database\Eloquent\Factories\Factory;

class VersionFactory extends Factory
{
    protected $model = Version::class;

    public function definition(): array
    {
        return [
            'dashboard_id' => Dashboard::factory(),
            'number' => 1,
        ];
    }
}
