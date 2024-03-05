<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wishlist extends Model
{
    use HasFactory;
    use HasUuids;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }


}
