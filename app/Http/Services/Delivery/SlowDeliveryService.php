<?php

namespace App\Http\Services\Delivery;

use App\Http\Requests\Delivery\DeliveryCreateRequest;
use App\Http\Requests\Delivery\DeliveryIndexRequest;
use App\Http\Services\Delivery\Interface\DeliveryServiceInterface;
use App\Models\Delivery;
use App\Models\DeliveryService;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class SlowDeliveryService implements DeliveryServiceInterface
{
    public function index(DeliveryIndexRequest $deliveryIndexRequest): Collection
    {
        $deliveries = Delivery::query()
            ->whereHas('deliveryService', function ($query) {
                $query->where('type', DeliveryService::TYPE_SLOW);
            })
            ->get();

        $deliveries = $deliveries->map(function (Delivery $delivery) {
            return $this->transformDelivery($delivery);
        });

        return $deliveries;
    }

    public function create(DeliveryCreateRequest $deliveryCreateRequest): Delivery
    {
        $serviceData = Arr::except($deliveryCreateRequest->service, ['price', 'date']);
        $serviceData['type'] = DeliveryService::TYPE_SLOW;

        $deliveryService = DeliveryService::create($serviceData);

        $deliveryData = Arr::except($deliveryCreateRequest->validated(), ['service', 'deliveryService']);
        $deliveryData['deliveryServiceId'] = $deliveryService->id;

        return $this->transformDelivery(
            Delivery::create($deliveryData)
        );
    }

    public function show(Delivery $delivery): Delivery
    {
        return $this->transformDelivery($delivery);
    }

    public function transformDelivery(Delivery $delivery): Delivery
    {
        $fromDay = Carbon::parse(now()->format('Y-m-d 18:00'));

        $delivery->deliveryService->price =
            $delivery->deliveryService->cost * $delivery->deliveryService->coefficient;
        $delivery->deliveryService->date =
            $fromDay->addDays($delivery->deliveryService->period);

        return $delivery;
    }
}
