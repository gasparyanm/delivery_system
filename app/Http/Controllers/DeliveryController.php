<?php

namespace App\Http\Controllers;

use App\Http\Requests\Delivery\DeliveryCreateRequest;
use App\Http\Requests\Delivery\DeliveryIndexRequest;
use App\Http\Resources\Delivery\DeliveryResource;
use App\Http\Services\Delivery\DeliveryService;
use App\Models\Delivery;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryController extends Controller
{
    public function index(
        DeliveryIndexRequest $deliveryIndexRequest,
        DeliveryService $deliveryService
    ): JsonResource {
        $deliveries = $deliveryService->index($deliveryIndexRequest);

        return DeliveryResource::collection($deliveries);
    }

    public function store(
        DeliveryCreateRequest $deliveryCreateRequest,
        DeliveryService $deliveryService,
        DatabaseManager $databaseManager
    ): JsonResponse {
        $delivery = $databaseManager->transaction(
            function () use ($deliveryService, $deliveryCreateRequest) {
                return $deliveryService->create($deliveryCreateRequest);
            }
        );

        return (new DeliveryResource($delivery))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    public function show(
        Delivery $delivery,
        DeliveryService $deliveryService,
    ): DeliveryResource {
        return new DeliveryResource(
            $deliveryService->show($delivery)
        );
    }
}
