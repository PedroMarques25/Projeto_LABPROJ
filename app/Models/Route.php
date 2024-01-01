<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route_image_path',
        'guide_id',
        'creation_date',
        'rating',
        'aboutIt',
        'total_price',
        'fee',
        'route_date',
        'total_slots',
        'remaining_available_slots',
        'duration'
    ];

    public function attractions(): BelongsToMany
    {
        return $this->belongsToMany(Attraction::class, 'attraction_route_pivot')
            ->withTimestamps();
    }

    public function guide(): BelongsTo
    {
        return $this->belongsTo(Guide::class);
    }

    public function calculateTotalPrice(): float
    {
        $attractionPrices = $this->attractions()->pluck('price')->toArray();
        $totalPrice = array_sum($attractionPrices);
        $fee = $this->fee ?? $this->faker->numberBetween(5, 20);

        return $totalPrice + $fee;
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

}
