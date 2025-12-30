<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendor;
use Faker\Factory as Faker;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();
        //buat 10 data vendor random
        for ($i = 0; $i < 10; $i++) {
            Vendor::create([
            'Vendor_ID'    => (string) Str::uuid(),
            'Name'         => $faker->company(),
            'Address'      => $faker->address(),
            'Phone_Number' => $faker->phoneNumber(),
            'Email'        => $faker->unique()->safeEmail(),
            'Password'     => Hash::make('password123'),
            'Image'        => 'vendor.png',
            ]);
        }
        
    }
}
