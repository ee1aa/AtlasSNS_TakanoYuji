<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()//UsersTableSeeder.phpを呼び出す
    {
        $this->call(UsersTableSeeder::class);
    }
}
