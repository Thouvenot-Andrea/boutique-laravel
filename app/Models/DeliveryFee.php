<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\DeliveryFee
 *
 * @property string $id
 * @property string $name
 * @property int $price
 * @property float $min_weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @method static \Database\Factories\DeliveryFeeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryFee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryFee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryFee whereMinWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryFee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryFee wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryFee whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeliveryFee extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'min_weight'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
