<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id'   => Company::inRandomOrder()->value('id') ?? Company::factory(),
            'product_name' => $this->faker->words(3, true),
            'price'        => $this->faker->numberBetween(500, 50000),
            'stock'        => $this->faker->numberBetween(0, 500),
            'comment'      => $this->faker->optional()->sentence(),
            'img_path'     => null,
        ];
    }
}