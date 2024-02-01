<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingItem extends Model
{
    use HasFactory;

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }

    public function order_item(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }
}
