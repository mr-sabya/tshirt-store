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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        User::create([
            'name' => 'Sabya Roy',
            'phone' => '01929190241', // You can set any phone number here
            'is_verified' => true,
            'password' => Hash::make('sabya12345'), // Set the desired admin password
            'city' => 'Khulna',
            'postcode' => '9100',
            'address' => 'Jora 4 tola',
            'is_admin' => true, // Mark as admin
        ]);
    }
}
