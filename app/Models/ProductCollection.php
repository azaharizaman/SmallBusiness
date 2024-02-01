<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCollection extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_product_collection')
            ->using(ProductProductCollection::class)
            ->withPivot('identifier')
            ->withTimestamps();
    }
}
