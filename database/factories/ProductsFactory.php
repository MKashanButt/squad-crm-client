<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Products;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'products' => $this->faker->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
