<?php

namespace Database\Factories;

use App\Models\DeliveryService;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryServiceFactory extends Factory
{
    protected $model = DeliveryService::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name,
            'type' => DeliveryService::TYPE_FAST,
            'price' => $this->faker->randomFloat(min:100, max:1000),
            'currency' => 'EUR',
            'date' => now()->format(DeliveryService::DATE_FORMAT),
            'period' => null,
            'coefficient' => null,
            'cost' => null,
        ];
    }
}
