<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use App\Models\Vendor;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Example images expected to be present in public/img
        $images = 'test.png';
        $vendorIds = Vendor::pluck('Vendor_ID')->toArray();

        // Create 10 sample products
        foreach ($vendorIds as $vendorId) {
                Product::create([
                'Product_ID' => (string) Str::uuid(),
                'Name' => 'Product 12',
                'Description' => $faker->sentence(8),
                'Price' => $faker->numberBetween(10000, 150000),
                'Vendor_ID' => $vendorId,
                'Stock' => $faker->numberBetween(1, 50),
                'Image' => $images,
            ]);

        }


    }
}
