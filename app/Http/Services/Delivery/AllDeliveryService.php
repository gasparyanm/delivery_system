<?php

namespace App\Http\Services\Delivery;

use App\Http\Requests\Delivery\DeliveryCreateRequest;
use App\Http\Requests\Delivery\DeliveryIndexRequest;
use App\Http\Services\Delivery\Interface\DeliveryServiceInterface;
use App\Models\Delivery;
use App\Models\DeliveryService;
use Illuminate\Support\Collection;

class AllDeliveryService implements DeliveryServiceInterface
{
    public function __construct(
        private FastDeliveryService $fastDeliveryService,
        private SlowDeliveryService $slowDeliveryService
    ) {
    }

    public function index(DeliveryIndexRequest $deliveryIndexRequest): Collection
    {
        $fastDeliveries = $this->fastDeliveryService->index($deliveryIndexRequest);

        $slowDeliveries = $this->slowDeliveryService->index($deliveryIndexRequest);

        return $fastDeliveries->merge($slowDeliveries);
    }

    public function create(DeliveryCreateRequest $deliveryCreateRequest): Delivery
    {
        return Delivery::make();
    }

    public function show(Delivery $delivery): Delivery
    {
        if ($delivery->deliveryService->type === DeliveryService::TYPE_FAST) {
            return $this->fastDeliveryService->show($delivery);
        } else {
            return $this->slowDeliveryService->show($delivery);
        }
    }
}
