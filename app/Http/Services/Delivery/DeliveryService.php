<?php

namespace App\Http\Services\Delivery;

use App\Http\Requests\Delivery\DeliveryCreateRequest;
use App\Http\Requests\Delivery\DeliveryIndexRequest;
use App\Http\Services\Delivery\Interface\DeliveryServiceInterface;
use App\Models\Delivery;
use Illuminate\Support\Collection;

final class DeliveryService implements DeliveryServiceInterface
{
    public function __construct(private DeliveryServiceInterface $deliveryServiceInterface)
    {
    }

    public function index(DeliveryIndexRequest $deliveryIndexRequest): Collection
    {
        return $this->deliveryServiceInterface->index($deliveryIndexRequest);
    }

    public function create(DeliveryCreateRequest $deliveryCreateRequest): Delivery
    {
        return $this->deliveryServiceInterface->create($deliveryCreateRequest);
    }

    public function show(Delivery $delivery): Delivery
    {
        return $this->deliveryServiceInterface->show($delivery);
    }
}
