<?php

namespace Database\Seeders;

use faker\Factory as Faker;
use App\Models\Wireframe;
use Illuminate\Database\Seeder;

class Fyp extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $WR = new Wireframe;
        $WR->Description = $faker->Description;
    }
}
