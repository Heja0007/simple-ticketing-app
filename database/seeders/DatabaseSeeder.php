<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Staff 1',
            'email' => 'staff1@staff.com',
            'password' => Hash::make('password'),
            'role' => 'staff'
        ]);

        User::create([
            'name' => 'Staff 2',
            'email' => 'staff2@staff.com',
            'password' => Hash::make('password'),
            'role' => 'staff'
        ]);
    }
}
