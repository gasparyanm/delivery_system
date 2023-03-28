<?php

namespace App\Http\Requests\Delivery;

use App\Models\Delivery;
use App\Models\DeliveryService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'sourceKladr' => [
                'required',
                'string',
            ],
            'targetKladr' => [
                'required',
                'string',
            ],
            'weight' => [
                'required',
                'numeric',
            ],
            'weightUnit' => [
                'required',
                Rule::in(Delivery::WEIGHT_UNITS),
            ],
            'deliveryService' => [
                'required',
                Rule::in(DeliveryService::TYPES),
            ],
            'service.name' => [
                'required',
                'string',
                'unique:delivery_services,name'
            ],
            'service.currency' => [
                'required',
                Rule::in(DeliveryService::CURRENCIES),
            ],
            'service.price' => [
                'required_if:deliveryService,' . DeliveryService::TYPE_FAST,
                'numeric',
                'min:0',
                'max:99999999.99',
            ],
            'service.date' => [
                'required_if:deliveryService,' . DeliveryService::TYPE_FAST,
                'date_format:' . DeliveryService::DATE_FORMAT,
            ],
            'service.cost' => [
                'required_if:deliveryService,' . DeliveryService::TYPE_SLOW,
                'numeric',
                'min:0',
            ],
            'service.coefficient' => [
                'required_if:deliveryService,' . DeliveryService::TYPE_SLOW,
                'numeric',
                'min:1',
            ],
            'service.period' => [
                'required_if:deliveryService,' . DeliveryService::TYPE_SLOW,
                'integer',
                'min:1',
            ]
        ];
    }
}
