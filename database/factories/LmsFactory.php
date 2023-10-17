<?php

namespace Database\Factories;

use App\Models\Lms;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LmsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lms::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'text' => $this->faker->text(),
        ];
    }
}
