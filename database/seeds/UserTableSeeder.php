<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        \App\User::create(array(
            'id'        => 1,
            'name'      => 'test',
            'email'     => 'test@test.com',
            'password'  => Hash::make('$sh4rpspr1nG$'),
            'api_token' => null
        ));
    }
}