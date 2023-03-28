<?php

namespace App\Http\Resources\Delivery;

use App\Models\DeliveryService;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'sourceKladr' => $this->sourceKladr,
            'targetKladr' => $this->targetKladr,
            'weight' => "{$this->weight} {$this->weightUnit}.",
            'serviceName' => $this->deliveryService->name,
            'price' => number_format($this->deliveryService->price, 2),
            'currency' => $this->deliveryService->currency,
            'date' => $this->deliveryService->date->format(DeliveryService::DATE_FORMAT),
        ];
    }
}
