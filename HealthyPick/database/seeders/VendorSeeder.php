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


    public function run(): void
    {
        $faker = Faker::create();


        for ($i = 0; $i < 10; $i++) {

            $user = User::create([
                'User_ID' => (string) Str::uuid(),
                'name' => $faker->company(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'password' => 'password123',
                'role' => 'vendor',
            ]);


            Vendor::create([
                'Vendor_ID' => (string) Str::uuid(),
                'User_ID' => $user->User_ID,
                'address' => $faker->address(),
                'image' => 'vendor.png', //ketika di deploy tidak bisa upload png tapi ketika lokal masih bisa
            ]);
        }


    }
}
