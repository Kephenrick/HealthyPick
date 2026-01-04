<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendor;
use App\Models\User;
use Faker\Factory as Faker;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();

        // Buat 10 data vendor
        for ($i = 0; $i < 10; $i++) {
            // 1. Buat User dengan role vendor
            $user = User::create([
                'User_ID' => (string) Str::uuid(),
                'name' => $faker->company(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'password' => 'password123',
                'role' => 'vendor',
            ]);

            // 2. Buat record di tabel vendors
            Vendor::create([
                'Vendor_ID' => (string) Str::uuid(),
                'User_ID' => $user->User_ID,
                'address' => $faker->address(),
                'image' => 'vendor.png',
            ]);
        }

        // Buat 1 vendor untuk testing dengan email dan password yang jelas
        $testUser = User::create([
            'User_ID' => (string) Str::uuid(),
            'name' => 'Test Vendor',
            'email' => 'vendor@test.com',
            'phone' => '081234567890',
            'password' => 'password123',
            'role' => 'vendor',
        ]);

        Vendor::create([
            'Vendor_ID' => (string) Str::uuid(),
            'User_ID' => $testUser->User_ID,
            'address' => 'Jl. Test Vendor No. 123',
            'image' => 'vendor.png',
        ]);
    }
}
