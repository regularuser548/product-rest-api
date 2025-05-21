<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseRecord extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'original_price',
        'quantity'
    ];

    /**
     * Get the user this record belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product for this record.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
