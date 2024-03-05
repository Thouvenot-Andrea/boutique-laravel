<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'product_id',
        'recommended_product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all 3 recommended products
     */
    public function recommendedProducts()
    {
        return $this->hasMany(Product::class, 'id', 'recommended_product_id');
    }
}
