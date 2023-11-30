<?php

namespace Database\Seeders;

use App\Models\Attraction;
use App\Models\City;
use App\Models\Country;
use App\Models\Guide;
use App\Models\Language;
use App\Models\Route;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::factory(5)->create();
        City::factory(20)->create();
        User::factory(10)->create();
        Type::factory(6)->create();
        Language::factory(7)->create();
        Attraction::factory(20)->create();
        Guide::factory(5)->create();
        Route::factory(10)->create();

    }
}
