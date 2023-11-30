<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route_image_path',
        'guide_id',
        'creation_date',
        'rating',
        'aboutIt'
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
}
