<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'=>'Jankaro',
            'email'=>'fuckme@easymarket.com',
            'password'=>Hash::make('12345678')

        ]);
    }
}
