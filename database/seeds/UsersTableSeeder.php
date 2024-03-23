<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['username' => 'Atlas一郎',
            'mail' => 'atlas1@gmail.com',
            'password' => bcrypt('password1')],
            ['username' => 'Atlas二郎',
            'mail' => 'atlas2@gmail.com',
            'password' => bcrypt('password1')],
            ['username' => 'Atlas三郎',
            'mail' => 'atlas3@gmail.com',
            'password' => bcrypt('password3')],
            ['username' => 'Atlas四郎',
            'mail' => 'atlas4@gmail.com',
            'password' => bcrypt('password4')],
            ['username' => 'Atlas五郎',
            'mail' => 'atlas5@gmail.com',
            'password' => bcrypt('password5')]
        ]);
    }
}
