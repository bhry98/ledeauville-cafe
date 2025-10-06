<?php

namespace Database\Seeders;

use app\Models\users\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        UserModel::query()->create([
            'name' => 'Super Admin',
            'email' => 'admin@cafe.com',
            "password" =>Hash::make("123"),
        ]);
    }
}
