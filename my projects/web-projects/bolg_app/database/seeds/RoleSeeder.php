<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::Create(['name'=>"administrator"]);
        Role::Create(['name'=>"author"]);
        Role::Create(['name'=>"subscriber"]);
    }
}
