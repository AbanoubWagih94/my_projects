<?php

use Illuminate\Database\Seeder;
use App\TravelSightSeeing;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 20; $i++)
        TravelSightSeeing::create([
            'travel_area_id' => rand(1,20),
            'time' => time()
        ]);
    }
}
