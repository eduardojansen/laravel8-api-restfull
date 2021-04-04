<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'api_token' => 'fKXxVoVBbNcEm1sGcAW0S0hbCcro5C6AnCdPI56dXYNJmuSbv8wlPRCAN5DKKtFm17K55Y7F9OJXDONp'
        ]);
    }
}
