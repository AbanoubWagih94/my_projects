<?php

use Illuminate\Database\Seeder;
use App\Order;
use Illuminate\Support\Carbon;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id'=> 1,
            'date' => Carbon::today(),
            'address' => '1st ahmed orabi el amrya',
            'status' => 1
        ]);
    }
}
