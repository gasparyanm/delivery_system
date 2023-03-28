<?php

namespace App\Http\Services\Delivery;

use App\Http\Requests\Delivery\DeliveryCreateRequest;
use App\Http\Requests\Delivery\DeliveryIndexRequest;
use App\Http\Services\Delivery\Interface\DeliveryServiceInterface;
use App\Models\Delivery;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Models\DeliveryService;

class FastDeliveryService implements DeliveryServiceInterface
{
    public function index(DeliveryIndexRequest $deliveryIndexRequest): Collection
    {
        $deliveries = Delivery::query()
            ->whereHas('deliveryService', function ($query) {
                $query->where('type', DeliveryService::TYPE_FAST);
            })
            ->get();

        return $deliveries;
    }

    public function create(DeliveryCreateRequest $deliveryCreateRequest): Delivery
    {
        $serviceData = Arr::except($deliveryCreateRequest->service, ['cost', 'coefficient', 'period']);
        $serviceData['type'] = DeliveryService::TYPE_FAST;

        $deliveryService = DeliveryService::create($serviceData);

        $deliveryData = Arr::except($deliveryCreateRequest->validated(), ['service', 'deliveryService']);
        $deliveryData['deliveryServiceId'] = $deliveryService->id;

        return Delivery::create($deliveryData);
    }

    public function show(Delivery $delivery): Delivery
    {
        return $delivery;
    }
}
