<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Recommendation
 *
 * @property string $id
 * @property string $product_id
 * @property string $recommended_product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $recommendedProducts
 * @property-read int|null $recommended_products_count
 * @method static \Database\Factories\RecommendationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereRecommendedProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
