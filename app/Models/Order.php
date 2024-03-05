<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Order extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'total',
        'status',
        'ordered_at',
        'delivered_at',
    ];


    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function delivery_fee() : hasOne
    {
        return $this->hasOne(DeliveryFee::class);
    }

    public function orderLine()
    {
        return $this->hasOne(OrderLine::class);
    }

}
