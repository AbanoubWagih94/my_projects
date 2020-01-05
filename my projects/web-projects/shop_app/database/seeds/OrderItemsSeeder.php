<?php

use Illuminate\Database\Seeder;
use App\OrderItems;
class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderItems::create([
            'order_id'=> 1,
            'product_id' => 1,
            'quantity' => 2,
            'price' => 4000
        ]);

        OrderItems::create([
            'order_id'=> 6,
            'product_id' => 2,
            'quantity' => 1,
            'price' => 233
        ]);
    }
}
