<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquence\Behaviours\CamelCasing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryService extends Model
{
    use HasFactory;
    use CamelCasing;

    public const DATE_FORMAT = 'Y-m-d';

    public const TYPE_FAST = 'fast';
    public const TYPE_SLOW = 'slow';

    public const TYPES = [
        self::TYPE_FAST,
        self::TYPE_SLOW,
    ];

    public const CURRENCIES = ['RUB', 'USD', 'EUR', 'AMD'];

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}
