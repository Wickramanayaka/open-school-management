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
        App\User::create([
            'name' => 'Administrator',
            'email' => 'admin@bs.com',
            'password' => \Hash::make('admin_password'),
            'status' => 1
        ]);
        App\UserRole::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
