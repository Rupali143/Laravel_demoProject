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
        DB::table('users')->insert([
            'name' => 'Neelam',
            'email' => 'neelam@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => str_random(10),
        ]);
    }
}
