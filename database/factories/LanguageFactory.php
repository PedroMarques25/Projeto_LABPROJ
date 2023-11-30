<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

    public function definition(): array
    {
        $languages = ['English', 'German', 'Spanish', 'French', 'Italian', 'Japanese', 'Portuguese', 'Norwegian', 'Swedish'];

        return [
            'name' => $this->faker->unique()->randomElement($languages),
        ];
    }
}
