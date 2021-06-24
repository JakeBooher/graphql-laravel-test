<?php

namespace Database\Factories;

use App\Models\Example;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExampleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Example::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'data' => [
                'key' => $this->faker->sentences(5, true),
            ],
            'data_not_selectable' => [
                'key' => $this->faker->sentences(5, true),
            ],
        ];
    }
}
