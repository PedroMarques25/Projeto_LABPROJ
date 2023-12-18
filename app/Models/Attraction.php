<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attraction extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type_id', 'city_id', 'about', 'price', 'attraction_image'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function routes(): BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'attraction_route_pivot');
    }
}
