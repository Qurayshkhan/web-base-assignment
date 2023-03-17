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
        User::firstOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
            ]

        );
    }
}
