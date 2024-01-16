<?php

namespace Database\Factories;

use App\Models\Attraction;
use App\Models\Guide;
use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RouteFactory extends Factory
{
    protected $model = Route::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'route_image_path' => "storage/route-default-image.jpg",
            'guide_id' => Guide::factory()->create()->id,
            'creation_date' => Carbon::now(),
            'rating' => $this->faker->randomFloat(2, 0, 5),
            'total_slots' => $this->faker->numberBetween(10, 50),
            'remaining_available_slots' => $this->faker->numberBetween(0, 10),
            'aboutIt' => $this->faker->text(200),
            'duration' => Carbon::createFromTime($this->faker->numberBetween(1, 1), 0, 0), // Random duration between 1 to 5 hours
        ];
    }

    public function configure(): RouteFactory
    {
        return $this->afterCreating(function (Route $route) {
            $attractions = Attraction::factory()->count(rand(2, 5))->create();
            $route->attractions()->attach($attractions);

            // Calculate total_price based on associated attractions' prices
            $attractionPrices = $attractions->pluck('price')->toArray();
            $totalPrice = array_sum($attractionPrices);
            $fee = $route->fee ?? $this->faker->numberBetween(5, 20); // Use existing fee or generate a random fee

            $route->total_price = $totalPrice + ($totalPrice * $fee / 100);
            $route->fee = $fee;

            $route->save();
        });
    }
}
