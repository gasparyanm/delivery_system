<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{
    use HasFactory;
    use CamelCasing;

    public const WEIGHT_UNITS = ['kg', 'g', 't'];

    protected $guarded = [];

    protected $with = ['deliveryService'];

    public function deliveryService(): BelongsTo
    {
        return $this->belongsTo(DeliveryService::class);
    }
}
