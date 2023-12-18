<?php

namespace App\Models;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class Guide extends Model
{
    use HasFactory;
    protected $fillable = [
        'rating',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function languages(): BelongsToMany
    {
        /*The withTimestamps() method in Laravel's Eloquent ORM
        automatically maintains the created_at and updated_at columns in the
        pivot table associated with a many-to-many relationship.*/
        return $this->belongsToMany(Language::class, 'guide_languages')->withTimestamps();
    }

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class);
    }

    public static function rating(): void
    {
        $guideRating = Guide::where('user_id', auth()->user()->id)->value('rating');
        session(['guide_rating' => $guideRating]);

    }
}
