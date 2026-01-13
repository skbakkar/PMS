<?php

namespace Database\Factories;

use App\Domain\Medicine\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Antibiotics',
                'Painkillers',
                'Vitamins',
                'Antihistamines',
                'Antacids',
                'Cardiovascular',
                'Diabetes',
                'Respiratory',
            ]),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
