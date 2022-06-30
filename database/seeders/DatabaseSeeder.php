<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Cely',
            'email' => 'cely@gmail.com',
            'is_admin' => true,
            'password' => Hash::make('123456789'),
        ]);

    }
}