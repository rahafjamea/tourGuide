<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
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

         Location::create([
             'title' => 'ommayad mosqe',
             'location' => 'location',
             'category' => 'historical',
             'opening_hours' => '6-7',
             'description'  => 'ffffffffffffffffffffffff',
             'is_hidden_gem' => false,
         ]);
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
    }
}
