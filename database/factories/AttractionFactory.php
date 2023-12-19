<?php

namespace Database\Factories;

use App\Models\Attraction;
use App\Models\Type;
use App\Models\City;
use Carbon\Carbon;
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
            'creation_date' => Carbon::now()
        ];
    }

    private function getRandomImageFromTypeFolder($typeId): string
    {
        // Get the list of files in the corresponding type folder
        $typeFolderPath = "/public/{$typeId}/";
        $files = Storage::files($typeFolderPath);
        // Select a random image from the folder

        if (!empty($files)) {
            $modifiedFiles = array_map(function ($file) {
                return str_replace('public/', 'storage/', $file);
            }, $files);

            // Select a random modified file path
            return $modifiedFiles[array_rand($modifiedFiles)];
        }

        // If no images found, return a default image path
        return "storage/Default/airplane-default.jpg";
    }
}
