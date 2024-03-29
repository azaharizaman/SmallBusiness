<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function business_partner(): BelongsTo
    {
        return $this->belongsTo(BusinessPartner::class);
    }
    
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function billing_address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }
}
