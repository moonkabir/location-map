<?php

namespace Database\Seeders;

use App\Models\Map;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 120) as $index) {
            Map::insert([
                'name' => $faker->name,
                'latitude' => $faker->latitude($min = 22, $max = 24),
                'longitude' => $faker->longitude($min = 89, $max = 91),
                'type' => 2,
                'details' => $faker->text,
            ]);
        }
    }
}
