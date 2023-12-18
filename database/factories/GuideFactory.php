<?php

namespace Database\Factories;

use App\Models\Guide;
use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GuideFactory extends Factory
{
    protected $model = Guide::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'rating' => $this->faker->randomFloat(2, 0, 5),
            'user_id' => User::factory()->create()->id,
        ];
    }

    public function configure(): GuideFactory
    {
        return $this->afterCreating(function (Guide $guide) {
            $languages = Language::inRandomOrder()->limit(rand(1, 3))->get();
            $guide->languages()->attach($languages);
        });
    }
}
