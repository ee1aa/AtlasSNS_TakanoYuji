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
        $users = [
            ['username' => 'Atlas一郎', 'mail' => 'atlas1@gmail.com', 'password' => bcrypt('password1'), 'images' => null],
            ['username' => 'Atlas二郎', 'mail' => 'atlas2@gmail.com', 'password' => bcrypt('password1'), 'images' => null],
            ['username' => 'Atlas三郎', 'mail' => 'atlas3@gmail.com', 'password' => bcrypt('password3'), 'images' => null],
            ['username' => 'Atlas四郎', 'mail' => 'atlas4@gmail.com', 'password' => bcrypt('password4'), 'images' => null],
            ['username' => 'Atlas五郎', 'mail' => 'atlas5@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas6', 'mail' => 'atlas6@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas7', 'mail' => 'atlas7@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas8', 'mail' => 'atlas8@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas9', 'mail' => 'atlas9@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas10', 'mail' => 'atlas10@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas11', 'mail' => 'atlas11@gmail.com', 'password' => bcrypt('password1'), 'images' => null],
            ['username' => 'Atlas12', 'mail' => 'atlas12@gmail.com', 'password' => bcrypt('password1'), 'images' => null],
            ['username' => 'Atlas13', 'mail' => 'atlas13@gmail.com', 'password' => bcrypt('password3'), 'images' => null],
            ['username' => 'Atlas14', 'mail' => 'atlas14@gmail.com', 'password' => bcrypt('password4'), 'images' => null],
            ['username' => 'Atlas15', 'mail' => 'atlas15@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas16', 'mail' => 'atlas16@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas17', 'mail' => 'atlas17@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas18', 'mail' => 'atlas18@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas19', 'mail' => 'atlas19@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
            ['username' => 'Atlas20', 'mail' => 'atlas20@gmail.com', 'password' => bcrypt('password5'), 'images' => null],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['mail' => $user['mail']],  // 一意の識別子としてメールを使用
                $user  // 更新または挿入するデータ
            );
        }
    }
}
