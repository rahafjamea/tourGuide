<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\Site;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();

        Site::create([
            'title' => 'ommayad mosqe',
            'location' => 'location',
            'category' => 'historicall',
            'opening_hours' => '6-7',
            'description'  => 'ffffffffffffffffffffffff',
            'is_hidden_gem' => false,
        ]);
        Site::create([
            'title' => 'ommayad mosqe',
            'location' => 'location',
            'category' => 'historical',
            'opening_hours' => '6-7',
            'description'  => 'ffffffffffffffffffffffff',
            'is_hidden_gem' => false,
        ]);
        Rating::create([
            'site_id' => 1,
            'user_id' => 3,
            'rating_out_five' => 3,
            'rating_text' => 'very nice'
        ]);
    }
}
