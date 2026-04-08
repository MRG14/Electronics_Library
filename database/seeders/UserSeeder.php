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
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin E_library',
            'email' => 'admin@mail.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'avatar_path' => 'avatars/sample.jpg'
        ]);

        // User
        User::create([
            'name' => 'John Doe',
            'email' => 'testuser@mail.com',
            'password' => Hash::make('123456789'),
            'role' => 'user',
            'avatar_path' => 'avatars/sample.jpg'
        ]);
    }
}
