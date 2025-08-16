<?php

namespace Database\Factories;

use App\Models\Widget;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\WidgetTypes;

class WidgetFactory extends Factory
{
    protected $model = Widget::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement([WidgetTypes::TEXT, WidgetTypes::LINK]);

        return [
            'version_id' => Version::factory(),
            'type' => $type,
            'data' => $type === WidgetTypes::TEXT
                ? ['text' => $this->faker->sentence()]
                : ['url' => $this->faker->url(), 'label' => $this->faker->word()],
            'sort' => 1,
        ];
    }
}
