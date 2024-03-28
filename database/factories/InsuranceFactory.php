<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Insurance;

class InsuranceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Insurance::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'insurance' => $this->faker->regexify('[A-Za-z0-9]{100}'),
        ];
    }
}
