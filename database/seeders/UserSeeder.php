<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        User::create([
            'email' => 'user1@gmail.com',
            'password' => Hash::make('passissed123'),
        ]);

        User::create([
            'email' => 'user2@gmail.com',
            'password' => Hash::make('passissed456'),
        ]);
    }
}
