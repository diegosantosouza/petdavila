<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            [
                'name'=>'teste',
                'crmv'=>'123456',
                'email'=>'test@mail.com',
                'password'=>Hash::make('123456789'),
                'admin'=>1,
            ],
        ]);
    }
}
