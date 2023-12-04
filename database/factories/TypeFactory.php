<?php

namespace Database\Factories;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeFactory extends Factory
{
    protected $model = Type::class;

    public function definition(): array
    {
        $types = ['Museum', 'Restaurant', 'Statue', 'Park', 'Landmark', 'Theatre', 'Hotel', 'Galleries', 'Library'];

        return [
            'name' => $this->faker->unique()->randomElement($types),
        ];
    }
}
