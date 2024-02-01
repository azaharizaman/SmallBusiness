<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function tax(): BelongsTo
    {
        return $this->belongsTo(Tax::class);
    }

    public function product_category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function inventory_transactions(): HasMany
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    public function product_pricings(): HasMany
    {
        return $this->hasMany(ProductPricing::class);
    }

    public function product_collections(): BelongsToMany
    {
        return $this->belongsToMany(ProductCollection::class, 'product_product_collction');
    }

    public function currentPricing(): HasOne
    {
        return $this->hasOne(ProductPricing::class)->ofMany([
            'effective_date' => 'max',
            'id' => 'max',
        ], function (Builder $query) {
            $query->where('effective_date', '<', now())->where(function (Builder $query) {
                $query->where('expiration_date', '>', now())
                ->orWhereNull('expiration_date');
            });
        });
    }
}
