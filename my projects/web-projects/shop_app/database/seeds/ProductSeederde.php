<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductSeederde extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name'=> 'test',
            'price' => 3000,
            'description' => 'test test test',
            'image_url' => '01.jpg'
        ]);
    }
}
