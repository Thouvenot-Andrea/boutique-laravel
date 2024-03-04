<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Order extends Model
{
    use HasFactory;

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
        return $this->hasOne(User::class, 'users_id');
    }

    public function delivery_fee() : hasOne
    {
        return $this->hasOne(DeliveryFee::class, 'delivery_fees_id');
    }

}
