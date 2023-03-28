<?php

namespace App\Http\Services\Delivery\Interface;

use App\Http\Requests\Delivery\DeliveryCreateRequest;
use App\Http\Requests\Delivery\DeliveryIndexRequest;
use App\Models\Delivery;
use Illuminate\Support\Collection;

interface DeliveryServiceInterface
{
    public function index(DeliveryIndexRequest $deliveryIndexRequest): Collection;

    public function create(DeliveryCreateRequest $deliveryCreateRequest): Delivery;

    public function show(Delivery $delivery): Delivery;
}
