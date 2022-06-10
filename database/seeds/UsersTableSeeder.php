<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user -> name = 'Davide Di Pietro';
        $user -> email = 'davide.dipietro3@gmail.com';
        $user -> password = bcrypt('password');
        $user -> save();

    }
}
