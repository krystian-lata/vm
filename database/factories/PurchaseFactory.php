<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;
    public function definition(): array
    {
        return [
            'created_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }
}
