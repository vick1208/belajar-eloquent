<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Like extends Pivot
{
    protected $table = "customers_likes_products";
    protected $foreignKey = "customer_id";
    protected $relatedKey = "product_id";
    public $timestamps = false;

    public function usesTimestamps():bool
    {
        return false;
    }

    /**
     * customer
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, "customer_id", "id");
    }
    /**
     * product
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }
}
