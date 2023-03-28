<?php

namespace Database\Factories;

use App\Models\DeliveryService;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'delivery_service_id' => DeliveryService::factory(),
            'source_kladr' => $this->faker->address(),
            'target_kladr' => $this->faker->address(),
            'weight' => $this->faker->randomFloat(max:1000),
            'weight_unit' => 'kg',
        ];
    }
}

