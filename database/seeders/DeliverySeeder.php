<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\DeliveryService;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    public function run()
    {
        $fastDeliveryService = DeliveryService::factory()->create();
        $slowDeliveryService = DeliveryService::factory()
            ->create([
                'type' => DeliveryService::TYPE_SLOW,
                'cost' => 150,
                'currency' => 'RUB',
                'coefficient' => 2.5,
                'period' => 5,
                'date' => null,
                'price' => null,
            ]);

        Delivery::factory()->for($fastDeliveryService)->create();
        Delivery::factory()->for($slowDeliveryService)->create();
    }
}
