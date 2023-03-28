<?php

namespace App\Providers;

use App\Http\Services\Delivery\AllDeliveryService;
use App\Http\Services\Delivery\DeliveryService;
use App\Http\Services\Delivery\FastDeliveryService;
use App\Http\Services\Delivery\SlowDeliveryService;
use App\Models\DeliveryService as DeliveryServiceModel;
use Illuminate\Support\ServiceProvider;

class DeliveryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DeliveryService::class, function ($app) {
            $deliveryService = $app->request->deliveryService;

            switch ($deliveryService) {
                case DeliveryServiceModel::TYPE_FAST:
                    $service = app(FastDeliveryService::class);
                    break;
                case DeliveryServiceModel::TYPE_SLOW:
                    $service = app(SlowDeliveryService::class);
                    break;
                default:
                    $service = app(AllDeliveryService::class);
                    break;
            }

            return new DeliveryService($service);
        });
    }

    public function provides(): array
    {
        return [DeliveryService::class];
    }
}
