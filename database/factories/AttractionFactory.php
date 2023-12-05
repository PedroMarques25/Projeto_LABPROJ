<?php

namespace Database\Factories;

use App\Models\Attraction;
use App\Models\Type;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Import the Str class


class AttractionFactory extends Factory
{
    protected $model = Attraction::class;

    public function definition(): array
    {
        $type = Type::inRandomOrder()->first();

        $name = $type->name . ' ' . $this->faker->unique()->word; // Using Str::title to capitalize the first letter

        $city = City::inRandomOrder()->first();

        $about = $this->faker->text(200);

        $price = $this->faker->randomFloat(2, 10, 100);

        $attractionImagePath = $this->getRandomImageFromTypeFolder($type->id);

        return [
            'name' => $name,
            'type_id' => $type->id,
            'city_id' => $city->id,
            'aboutIt' => $about,
            'price' => $price,
            'attraction_image_path' => $attractionImagePath,
        ];
    }

    private function getRandomImageFromTypeFolder($typeId): string
    {
        // Get the list of files in the corresponding type folder
       // $typeFolderPath = "storage/{$typeId}/";
        $typeFolderPath = "storage/{$typeId}/";
        $files = Storage::files($typeFolderPath);
        // Select a random image from the folder
        if (!empty($files)) {
            //$randomImage = $files[array_rand($files)];
            return asset($files[rand(0, 1)]); // Return the full path to the image
        }

        // If no images found, return a default or placeholder image path
        return "storage/Default/airplane-default.jpg";
    }
}
