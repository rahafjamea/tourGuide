<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\CategorySite;
use App\Models\Rating;
use App\Models\Route;
use App\Models\RouteSite;
use App\Models\Site;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(5)->create();

        /*User::create([
            'name' => 'rahaf jamea',
            'nationality' => 'Syrian',
            'email' => 'rahaf@gmail.com',
            'password' => '345678'
        ]);*/
        Site::create([
            'title' => 'ommayad mosqe',
            'longitude' => '333',
            'latitude' => '666',
            //'category' => 'historicall',
            'opening_hours' => '6-7',
            'description' => 'ffffffffffffffffffffffff'
        ]);
        Site::create([
            'title' => 'ommayad mosqe',
            'longitude' => '333',
            'latitude' => '666',
            //'category' => 'historical',
            'opening_hours' => '6-7',
            'description' => 'ffffffffffffffffffffffff'
        ]);
        // Rating::create([
        //     'site_id' => 1,
        //     'user_id' => 3,
        //     'rating_out_five' => 3,
        //     'rating_text' => 'very nice'
        // ]);
        Category::create([
            'category_title' => 'historical'
        ]);
        CategorySite::create([
            'category_id' => 1,
            'site_id' => 1
        ]);
        // Route::create([
        //     'user_id' => 1,
        //     'no_of_days' => 3
        // ]);
        // RouteSite::create([
        //     'route_id' => 1,
        //     'site_id' => 1,
        //     'order' => 1,
        //     'day' => 1
        // ]);
    }
}
