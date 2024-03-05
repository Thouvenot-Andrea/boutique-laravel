<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recommendation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'product_id',
        'recommended_product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all 3 recommended products
     */
    public function recommendedProducts(): HasMany
    {
        return $this->hasMany(Product::class, 'id', 'recommended_product_id');
    }
}
