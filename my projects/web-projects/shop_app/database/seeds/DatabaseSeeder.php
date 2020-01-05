<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(AdminUserSeeder::class);
        //$this->call(UserSeeder::class);
        $this->call(OrderItemsSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ProductSeederde::class);
    }
}
