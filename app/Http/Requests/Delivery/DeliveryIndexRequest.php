<?php

namespace App\Http\Requests\Delivery;

use App\Models\DeliveryService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryIndexRequest extends FormRequest
{
    public function rules()
    {
        return [
            'deliveryService' => [
                'sometimes',
                Rule::in(DeliveryService::TYPES),
            ]
        ];
    }
}
